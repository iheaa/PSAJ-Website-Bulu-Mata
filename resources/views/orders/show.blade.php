@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20 pt-10 font-sans text-gray-800">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Breadcrumb / Back -->
        <div class="mb-6">
            <a href="{{ route('orders.index') }}"
                class="inline-flex items-center text-sm text-gray-500 hover:text-orange-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Pesanan
            </a>
        </div>

        <!-- Header: Order ID & Status -->
        <div
            class="bg-white rounded-t-xl shadow-sm border border-gray-100 p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <p class="text-sm text-gray-500 mt-1">Dibuat pada {{ $order->created_at->format('d F Y, H:i') }}</p>
            </div>

            @php
            $statusClasses = [
            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            'unpaid' => 'bg-red-100 text-red-800 border-red-200',
            'paid' => 'bg-green-100 text-green-800 border-green-200',
            'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
            'shipped' => 'bg-purple-100 text-purple-800 border-purple-200',
            'completed' => 'bg-gray-100 text-gray-800 border-gray-200',
            'cancelled' => 'bg-red-50 text-red-600 border-red-100',
            ];
            $statusLabel = [
            'pending' => 'Menunggu Pembayaran',
            'unpaid' => 'Belum Dibayar',
            'paid' => 'Sudah Dibayar',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            ];
            $currentStatus = strtolower($order->status);
            $class = $statusClasses[$currentStatus] ?? 'bg-gray-100 text-gray-800 border-gray-200';
            $label = $statusLabel[$currentStatus] ?? ucfirst($currentStatus);
            @endphp
            <div class="flex flex-col items-end">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold border {{ $class }}">
                    {{ $label }}
                </span>
            </div>
        </div>

        <!-- Progress Tracker -->
        <div class="bg-white border-x border-b border-gray-100 p-6 md:p-8 mb-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-between">
                    @php
                    $steps = ['pending', 'paid', 'processing', 'shipped'];
                    $labels = ['Dipesan', 'Dibayar', 'Diproses', 'Dikirim'];
                    $currentIdx = array_search(strtolower($order->status), $steps);
                    if ($currentIdx === false && strtolower($order->status) == 'completed') $currentIdx = 4;
                    @endphp

                    @foreach($steps as $key => $step)
                    @php
                    $isCompleted = $key <= $currentIdx; $isCurrent=$key===$currentIdx; @endphp <div
                        class="flex flex-col items-center">
                        <div
                            class="h-8 w-8 rounded-full flex items-center justify-center {{ $isCompleted ? 'bg-green-500' : 'bg-gray-200' }} ring-4 ring-white">
                            @if($isCompleted)
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <span class="text-xs text-gray-500 font-bold">{{ $key + 1 }}</span>
                            @endif
                        </div>
                        <div class="mt-2 text-xs font-medium {{ $isCompleted ? 'text-green-600' : 'text-gray-500' }}">{{
                            $labels[$key] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <!-- Left: Items -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-900">Rincian Produk</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                    <div class="p-6 flex items-start gap-4">
                        <!-- Thumbnail -->
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex-shrink-0">
                            @if($item->product && $item->product->image)
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product_name }}"
                                class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <h3 class="text-sm font-bold text-gray-900">{{ $item->product_name }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->quantity }} x Rp {{
                                number_format($item->price, 0, ',', '.') }}</p>
                        </div>

                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.')
                                }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Payment Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-900">Info Pengiriman & Pelanggan</h2>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Penerima</p>
                        <p class="text-sm font-bold text-gray-900">{{ $order->customer_name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold mb-1">Alamat Pengiriman</p>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $order->customer_address }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <h2 class="text-lg font-bold text-gray-900">Rincian Pembayaran</h2>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Total Harga ({{ $order->items->count() }} barang)</span>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Biaya Pengiriman</span>
                        <span class="text-green-600 font-medium">Gratis</span>
                    </div>
                    <div class="border-t border-dashed border-gray-200 pt-4 mt-2">
                        <div class="flex justify-between items-end">
                            <span class="text-base font-bold text-gray-900">Total Bayar</span>
                            <span class="text-xl font-bold text-orange-600">Rp {{ number_format($order->total_price, 0,
                                ',', '.') }}</span>
                        </div>
                    </div>

                    @if($order->status == 'pending')
                    <button onclick="window.snap.pay('{{ $order->snap_token }}')"
                        class="w-full mt-6 bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl transition-all shadow-md">
                        Bayar Sekarang
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@if($order->status == 'pending')
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>
@endif

@endsection