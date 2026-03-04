<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    /**
     * Download invoice PDF for the authenticated user's order.
     */
    public function invoicePdf($id)
    {
        $order = Order::with(['items', 'user'])
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $pdf = Pdf::loadView('layouts.invoices.pdf', compact('order'))->setPaper('a4', 'portrait');
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}