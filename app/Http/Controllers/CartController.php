<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $catalog = \App\Models\Catalog::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        // Strict Stock Validation
        if ($quantity > $catalog->stock) {
            return response()->json([
                'success' => false,
                'message' => "Maaf, stok tidak mencukupi. Stok tersisa: {$catalog->stock}"
            ], 422);
        }

        if (isset($cart[$id])) {
            $newQuantity = $cart[$id]['quantity'] + $quantity;
            if ($newQuantity > $catalog->stock) {
                return response()->json([
                    'success' => false,
                    'message' => "Gagal menambahkan! Stok tidak mencukupi. Stok tersisa: {$catalog->stock}"
                ], 422);
            }
            $cart[$id]['quantity'] = $newQuantity;
        }
        else {
            $cart[$id] = [
                "id" => $id,
                "name" => $catalog->name,
                "quantity" => $quantity,
                "price" => $catalog->price,
                "image" => $catalog->image,
                "stock" => $catalog->stock,
                "image_url" => asset($catalog->image)
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            $totalQty = array_sum(array_column($cart, 'quantity'));
            return response()->json(['success' => true, 'cartCount' => $totalQty]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $catalog = \App\Models\Catalog::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');

        if ($quantity > $catalog->stock) {
            return response()->json([
                'success' => false,
                'message' => "Maaf, stok tidak mencukupi. Stok tersisa: {$catalog->stock}"
            ], 422);
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully!');
    }
}