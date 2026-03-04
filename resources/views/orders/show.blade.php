@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20 pt-10 font-sans text-gray-800">
    <div class="container mx-auto px-4 max-w-4xl lg:max-w-6xl">

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

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100">
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
            <div class="p-6 md:p-8">
            @php
                $steps = ['pending', 'paid', 'processing', 'shipped', 'completed'];
                $labels = ['Pesanan Dibuat', 'Dibayar', 'Diproses', 'Dikirim', 'Selesai'];
                $currentStatus = strtolower($order->status);
                $statusForProgress = ($currentStatus === 'unpaid') ? 'pending' : $currentStatus;
                $currentIdx = array_search($statusForProgress, $steps);
                if ($currentIdx === false) $currentIdx = -1;
            @endphp
            <div class="relative">
                {{-- Garis penghubung: abu-abu penuh, hijau sampai step saat ini --}}
                <div class="absolute top-5 left-0 right-0 h-0.5 bg-gray-200 rounded pointer-events-none"
                    aria-hidden="true" style="margin-left: 10%; margin-right: 10%; width: 80%;"></div>
                @php $linePercent = $currentIdx >= 0 ? (($currentIdx + 1) / count($steps)) * 80 : 0; @endphp
                <div class="absolute top-5 left-0 h-0.5 bg-green-500 rounded pointer-events-none transition-all duration-300"
                    aria-hidden="true" style="margin-left: 10%; width: {{ $linePercent }}%;"></div>
                <div class="relative flex justify-between">
                    @foreach($steps as $key => $step)
                        @php $isCompleted = $key <= $currentIdx; @endphp
                        <div class="flex flex-col items-center flex-1">
                            <div
                                class="relative h-10 w-10 rounded-full flex items-center justify-center flex-shrink-0 {{ $isCompleted ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' }} ring-4 ring-white shadow-sm z-10">
                                @if($key === 0)
                                    {{-- Ikon: Dokumen / Pesanan Dibuat --}}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                @elseif($key === 1)
                                    {{-- Ikon: Pembayaran --}}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @elseif($key === 2)
                                    {{-- Ikon: Diproses / Kotak --}}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                @elseif($key === 3)
                                    {{-- Ikon: Truk / Dikirim --}}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 17a2 2 0 11-4 0 2 2 0 014 0zM16 17a2 2 0 11-4 0 2 2 0 014 0zM5 7h14l2 4H3L5 7z" />
                                    </svg>
                                @else
                                    {{-- Ikon: Selesai / Bintang --}}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                @endif
                                @if($isCompleted)
                                    <span
                                        class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full bg-blue-500 flex items-center justify-center ring-2 ring-white">
                                        <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </span>
                                @endif
                            </div>
                            <div
                                class="mt-2 text-xs font-medium text-center {{ $isCompleted ? 'text-green-600' : 'text-gray-500' }}">
                                {{ $labels[$key] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            </div>
        </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-8 items-start">
        <div class="lg:col-span-3 space-y-6">
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

        <div class="lg:col-span-2">
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

                    @if(in_array(strtolower($order->status), ['pending', 'unpaid']))
                    <button id="btn-pay-now"
                        class="w-full mt-6 bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl transition-all shadow-md disabled:opacity-70 disabled:cursor-not-allowed">
                        Bayar Sekarang
                    </button>
                    @endif
                    <a href="{{ route('orders.invoice', $order->id) }}"
                        class="mt-3 w-full inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 bg-white hover:bg-gray-50">
                        Download Invoice (PDF)
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@if(in_array(strtolower($order->status), ['pending', 'unpaid']))
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const payBtn = document.getElementById('btn-pay-now');
        if (!payBtn || typeof window.snap === 'undefined') return;

        function setLoading(state) {
            if (!payBtn) return;
            payBtn.disabled = state;
            payBtn.textContent = state ? 'Memuat pembayaran...' : 'Bayar Sekarang';
        }

        payBtn.addEventListener('click', function () {
            setLoading(true);
            fetch("{{ route('orders.pay', $order->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({})
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.success || !data.snap_token) {
                        setLoading(false);
                        alert(data.message || 'Gagal memulai pembayaran. Silakan coba lagi.');
                        return;
                    }

                    window.snap.pay(data.snap_token, {
                        onSuccess: function () {
                            window.location.href =
                                "{{ route('payment.finish') }}" + "?order_id={{ $order->id }}";
                        },
                        onPending: function () {
                            setLoading(false);
                        },
                        onError: function () {
                            setLoading(false);
                            alert('Terjadi kesalahan saat memproses pembayaran.');
                        },
                        onClose: function () {
                            setLoading(false);
                        }
                    });
                })
                .catch(() => {
                    setLoading(false);
                    alert('Tidak dapat menghubungi server. Silakan periksa koneksi Anda dan coba lagi.');
                });
        });
    });
</script>
@endif

@endsection