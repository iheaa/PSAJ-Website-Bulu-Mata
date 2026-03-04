<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Exports\OrdersExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }

    public function show($id)
    {
        $order = Order::with(['items', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Download invoice PDF for any order (admin).
     */
    public function invoicePdf($id)
    {
        $order = Order::with(['items', 'user'])->findOrFail($id);
        $pdf = Pdf::loadView('layouts.invoices.pdf', compact('order'))->setPaper('a4', 'portrait');
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders-' . date('Y-m') . '.xlsx');
    }

    /**
     * Export monthly sales & revenue summary as PDF.
     */
    public function exportMonthlyPdf(Request $request)
    {
        $month = (int) ($request->query('month', now()->month));
        $year = (int) ($request->query('year', now()->year));

        $items = OrderItem::select(
            'product_name',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('SUM(subtotal) as total_revenue')
        )
            ->whereHas('order', function ($q) use ($month, $year) {
                $q->whereIn('status', ['paid', 'processing', 'shipped', 'completed'])
                    ->whereMonth('created_at', $month)
                    ->whereYear('created_at', $year);
            })
            ->groupBy('product_name')
            ->orderBy('product_name')
            ->get();

        $totalRevenue = (int) $items->sum('total_revenue');
        $monthName = Carbon::create($year, $month, 1)->locale('id')->translatedFormat('F Y');

        $pdf = Pdf::loadView('admin.reports.monthly', [
            'items' => $items,
            'totalRevenue' => $totalRevenue,
            'month' => $month,
            'year' => $year,
            'monthName' => $monthName,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('laporan-penjualan-' . $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '.pdf');
    }
}