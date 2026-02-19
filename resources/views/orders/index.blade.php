@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20 pt-10 font-sans text-gray-800">
    <div class="container mx-auto px-4 max-w-5xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 tracking-tight">Riwayat Pesanan</h1>
        <br>
        <br>


        @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6 md:flex md:items-center md:justify-between gap-6">
                    <!-- Order Info -->
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-sm font-bold text-gray-900">Order #{{ $order->id }}</span>
                            <span class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>

                        <!-- Status Badge -->
                        <div>
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
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $class }}">
                                {{ $label }}
                            </span>
                        </div>
                    </div>

                    <!-- Total & Action -->
                    <div class="mt-4 md:mt-0 flex items-center justify-between md:justify-end gap-6 w-full md:w-auto">
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Belanja</p>
                            <p class="text-lg font-bold text-orange-600">Rp {{ number_format($order->total_price, 0,
                                ',', '.') }}</p>
                        </div>
                        <a href="{{ route('orders.show', $order->id) }}"
                            class="inline-flex items-center justify-center px-4 py-2 border border-orange-600 text-sm font-medium rounded-lg text-orange-600 bg-white hover:bg-orange-50 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div
            class="flex flex-col items-center justify-center py-24 bg-white mx-4 rounded-xl shadow-sm border border-gray-100 text-center">
            <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h2>
            <p class="text-gray-500 mb-8 max-w-md">Anda belum melakukan transaksi apapun. Yuk mulai belanja!</p>
            <br>
            <a href="{{ route('catalog.index') }}"
                class="bg-orange-600 font-bold py-3 px-8 rounded-full hover:bg-orange-700 transition-all shadow-lg hover:shadow-orange-200">
                Mulai Belanja
            </a>
        </div>
        @endif
    </div>
</div>
@endsection