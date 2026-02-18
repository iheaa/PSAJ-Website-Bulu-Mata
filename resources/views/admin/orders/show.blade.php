@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}"
        class="inline-flex items-center text-sm text-gray-500 hover:text-indigo-600 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Orders
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden max-w-5xl mx-auto">
    <!-- Header -->
    <div class="bg-gray-50 px-8 py-6 border-b border-gray-200 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Invoice #{{ $order->id }}</h1>
            <p class="text-sm text-gray-500 mt-1">Order Date: {{ $order->created_at->format('d F Y, H:i') }}</p>
        </div>
        <div>
            <span class="px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide
                {{ $order->status == 'paid' ? 'bg-green-100 text-green-800' : '' }}
                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $order->status == 'shipped' ? 'bg-purple-100 text-purple-800' : '' }}
                {{ $order->status == 'completed' ? 'bg-gray-100 text-gray-800' : '' }}
                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                {{ $order->status }}
            </span>
        </div>
    </div>

    <div class="p-8">
        <!-- Addresses -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div>
                <h3 class="text-xs uppercase tracking-wide text-gray-500 font-bold mb-3">Customer Information</h3>
                <p class="font-bold text-gray-900">{{ $order->customer_name }}</p>
                <p class="text-gray-600">{{ $order->customer_phone }}</p>
                <p class="text-gray-600 mt-2 text-sm">Authenticated User ID: {{ $order->user_id ?? 'Guest' }}</p>
            </div>
            <div>
                <h3 class="text-xs uppercase tracking-wide text-gray-500 font-bold mb-3">Shipping Address</h3>
                <p class="text-gray-600 leading-relaxed">{{ $order->customer_address }}</p>
            </div>
        </div>

        <!-- Items Table -->
        <div class="border border-gray-200 rounded-lg overflow-hidden mb-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantity</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($item->product && $item->product->image)
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded object-cover" src="{{ asset($item->product->image) }}"
                                        alt="">
                                </div>
                                @endif
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-900">Grand Total</td>
                        <td class="px-6 py-4 text-right font-bold text-indigo-600 text-lg">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Status Management Action -->
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-center justify-between">
            <span class="text-sm text-gray-900 font-medium">Update Order Status:</span>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST"
                class="flex items-center gap-2">
                @csrf
                @method('PATCH')
                <select name="status"
                    class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing
                    </option>
                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection