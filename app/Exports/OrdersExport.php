<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Export current month's orders
        return Order::with('items')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Order ID',
            'Customer Name',
            'Product Name',
            'Quantity',
            'Price (IDR)',
            'Status',
        ];
    }

    public function map($order): array
    {
        $rows = [];
        foreach ($order->items as $item) {
            $rows[] = [
                $order->created_at->format('Y-m-d H:i'),
                $order->id,
                $order->customer_name,
                $item->product_name,
                $item->quantity,
                $item->price,
                ucfirst($order->status),
            ];
        }
        return $rows;
    }
}