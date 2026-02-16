@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl p-8 text-center border border-gray-100">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-2">Terima Kasih!</h1>
        <p class="text-gray-500 mb-8">Pesanan Anda telah berhasil dibuat.</p>

        <div class="bg-gray-50 rounded-xl p-6 mb-8 text-left">
            <div class="flex justify-between mb-3">
                <span class="text-gray-500 text-sm">Order ID</span>
                <span class="text-gray-900 font-bold">#{{ $order->id }}</span>
            </div>
            <div class="flex justify-between mb-3">
                <span class="text-gray-500 text-sm">Total Pembayaran</span>
                <span class="text-orange-600 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-gray-200 my-3"></div>
            <div class="text-xs text-center text-gray-400">
                Silakan lakukan pembayaran sesuai instruksi yang akan dikirimkan ke WhatsApp Anda.
            </div>
        </div>

        <a href="{{ route('catalog.index') }}"
            class="block w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-gray-800 transition-colors">
            Kembali ke Katalog
        </a>
    </div>
</div>
@endsection