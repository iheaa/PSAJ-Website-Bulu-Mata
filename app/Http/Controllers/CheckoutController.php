<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $subtotal = 0;

        foreach ($cart as $key => $item) {
            // Ensure strict integer typing for math
            $price = (int)$item['price'];
            $quantity = (int)$item['quantity'];

            // Update the cart item in memory for the view loop to be safe
            $cart[$key]['price'] = $price;
            $cart[$key]['quantity'] = $quantity;

            $subtotal += $price * $quantity;
        }

        $shipping = 0;
        $grandTotal = $subtotal + $shipping;

        return view('cart', compact('cart', 'subtotal', 'grandTotal'));
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += (int)$item['price'] * (int)$item['quantity'];
        }
        $grandTotal = $subtotal;

        return view('checkout-details', compact('cart', 'subtotal', 'grandTotal'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $qty = (int)$request->input('quantity');
            $catalog = \App\Models\Catalog::find($id);

            if (!$catalog) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }

            // Constraint: Check Stock
            if ($qty > $catalog->stock) {
                return response()->json([
                    'success' => false,
                    'message' => "Stok tidak mencukupi (Sisa: {$catalog->stock})"
                ], 422);
            }

            if ($qty < 1)
                $qty = 1;

            $cart[$id]['quantity'] = $qty;
            session()->put('cart', $cart);

            // Recalculate totals for response
            $subtotal = 0;
            $itemTotal = $cart[$id]['price'] * $qty;
            $totalQty = 0;

            foreach ($cart as $c) {
                $subtotal += $c['price'] * $c['quantity'];
                $totalQty += $c['quantity'];
            }

            return response()->json([
                'success' => true,
                'itemTotal' => $itemTotal,
                'grandTotal' => $subtotal, // Shipping is 0
                'totalQty' => $totalQty
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Item not in cart'], 404);
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        // Recalculate totals
        $subtotal = 0;
        $totalQty = 0;
        foreach ($cart as $c) {
            $subtotal += $c['price'] * $c['quantity'];
            $totalQty += $c['quantity'];
        }

        return response()->json([
            'success' => true,
            'grandTotal' => $subtotal,
            'totalQty' => $totalQty
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('catalog.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // DB Transaction for data integrity
        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            // 1. Calculate Total & Verify Stock
            $totalPrice = 0;
            foreach ($cart as $id => $item) {
                $catalog = \App\Models\Catalog::lockForUpdate()->find($id);

                if (!$catalog) {
                    throw new \Exception("Produk {$item['name']} tidak lagi tersedia.");
                }

                if ($catalog->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$item['name']} tidak mencukupi.");
                }

                $totalPrice += (int)$item['price'] * (int)$item['quantity'];
            }

            // 2. Create Order
            $order = \App\Models\Order::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_price' => $totalPrice,
                'status' => 'pending', // Default status
            ]);

            // 3. Create Order Items & Decrement Stock
            foreach ($cart as $id => $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'catalog_id' => $id,
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => (int)$item['price'] * (int)$item['quantity'],
                ]);

                // Decrement stock
                $catalog = \App\Models\Catalog::find($id);
                $catalog->decrement('stock', $item['quantity']);
            }

            \Illuminate\Support\Facades\DB::commit();

            // Clear Cart
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id)->with('success', 'Pesanan berhasil dibuat!');

        }
        catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = \App\Models\Order::with('items')->findOrFail($id);
        return view('checkout.success', compact('order'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang belanja kosong.'], 400);
        }

        // DB Transaction
        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            // 1. Calculate Total & Verify Stock (Do not decrement yet per instruction)
            $totalPrice = 0;
            $items = [];

            foreach ($cart as $id => $item) {
                $catalog = \App\Models\Catalog::lockForUpdate()->find($id);
                if (!$catalog || $catalog->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$item['name']} tidak mencukupi.");
                }
                $totalPrice += (int)$item['price'] * (int)$item['quantity'];

                $items[] = [
                    'id' => $id,
                    'price' => (int)$item['price'],
                    'quantity' => (int)$item['quantity'],
                    'name' => substr($item['name'], 0, 50) // Midtrans limit
                ];
            }

            // 2. Create Order (Status: pending)
            $order = \App\Models\Order::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // Midtrans Order ID
            $midtransOrderId = 'NARITA-' . $order->id . '-' . time();

            foreach ($cart as $id => $item) {
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'catalog_id' => $id,
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => (int)$item['price'],
                    'subtotal' => (int)$item['price'] * (int)$item['quantity'],
                ]);
            }

            // 3. Configure Midtrans
            $serverKey = config('services.midtrans.server_key');
            $clientKey = config('services.midtrans.client_key');

            if (empty($serverKey) || empty($clientKey)) {
                throw new \Exception('System configuration error. Please contact admin. (Midtrans keys not configured)');
            }

            \Midtrans\Config::$serverKey = $serverKey;
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production', false);
            \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized', true);
            \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds', true);

            // 4. Create Params
            $params = [
                'transaction_details' => [
                    'order_id' => $midtransOrderId,
                    'gross_amount' => (int)$totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'billing_address' => [
                        'address' => $request->customer_address
                    ],
                    'shipping_address' => [
                        'address' => $request->customer_address
                    ]
                ],
                'item_details' => $items,
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            \Illuminate\Support\Facades\DB::commit();

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_db_id' => $order->id
            ]);

        }
        catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        // Called after success callback from Frontend
        $orderId = $request->query('order_id');

        $order = \App\Models\Order::find($orderId);

        if (!$order) {
            return redirect()->route('catalog.index')->with('error', 'Order not found.');
        }

        if ($order->status !== 'paid') {
            // Update Status
            $order->status = 'paid';
            $order->save();

            // Decrement Stock
            $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();
            foreach ($orderItems as $item) {
                $catalog = \App\Models\Catalog::find($item->catalog_id);
                if ($catalog) {
                    $catalog->stock = max(0, $catalog->stock - $item->quantity);
                    $catalog->save();
                }
            }

            // Clear Cart
            session()->forget('cart');
        }

        return redirect()->route('checkout.success', $order->id)->with('success', 'Pembayaran berhasil!');
    }
}