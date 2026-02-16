@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20 pt-10 font-sans text-gray-800">
    <div class="container mx-auto px-4 max-w-6xl">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 tracking-tight">Shopping Cart</h1>

        <br>
        <br>


        <!-- Toast Notification Area -->
        <div id="toast-container" class="fixed top-5 right-5 z-50 space-y-4">
            @if(session('error'))
            <div
                class="bg-red-50 text-red-700 px-6 py-4 rounded-lg shadow-lg border-l-4 border-red-500 flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            @endif
        </div>

        @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- LEFT COLUMN: Product List -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <h2 class="text-lg font-bold text-gray-800">Daftar Produk</h2>
                        <span class="text-sm text-gray-500">{{ count($cart) }} Items</span>
                    </div>
                    <div class="divide-y divide-gray-100 p-6">
                        @foreach($cart as $item)
                        <div class="flex flex-col sm:flex-row items-center gap-6 py-6 first:pt-0 last:pb-0 transition hover:bg-gray-50/50 rounded-lg px-2"
                            id="item-row-{{ $item['id'] }}">
                            <!-- Image -->
                            <div
                                class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0 border border-gray-200 shadow-sm">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                    class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Details -->
                            <div class="flex-1 text-center sm:text-left w-full">
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-500 mb-3">
                                    Sisa Stok: <span class="font-medium text-gray-700">{{ $item['stock'] }}</span>
                                    <span class="mx-2">•</span>
                                    <span class="font-medium text-gray-900">@ {{ 'Rp ' .
                                        number_format((int)$item['price'], 0, ',', '.') }}</span>
                                </p>

                                <div class="flex items-center justify-center sm:justify-start gap-4">
                                    <!-- Stepper -->
                                    <div
                                        class="flex items-center border border-gray-300 rounded-lg bg-white h-10 w-32 shadow-sm focus-within:ring-2 focus-within:ring-orange-500 focus-within:border-transparent transition-all">
                                        <button type="button" onclick="updateQty({{ $item['id'] }}, -1)"
                                            class="w-10 h-full flex items-center justify-center text-gray-500 hover:bg-gray-100 rounded-l-lg transition hover:text-gray-900 font-bold text-lg focus:outline-none">-</button>
                                        <input type="text" id="qty-{{ $item['id'] }}" readonly
                                            value="{{ $item['quantity'] }}"
                                            class="flex-1 w-full text-center border-none p-0 text-gray-900 font-bold focus:ring-0 cursor-default select-none">
                                        <button type="button" onclick="updateQty({{ $item['id'] }}, 1)"
                                            class="w-10 h-full flex items-center justify-center text-gray-500 hover:bg-gray-100 rounded-r-lg transition hover:text-gray-900 font-bold text-lg focus:outline-none">+</button>
                                    </div>

                                    <!-- Trash -->
                                    <button type="button" onclick="removeItem({{ $item['id'] }})"
                                        class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors border border-transparent hover:border-red-100"
                                        aria-label="Hapus Item">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="flex-shrink-0 text-right min-w-[120px]">
                                <span
                                    class="text-xs text-gray-400 block mb-1 uppercase tracking-wider font-semibold">Total</span>
                                <span class="text-lg font-bold text-orange-600" id="subtotal-{{ $item['id'] }}">
                                    Rp {{ number_format((int)$item['price'] * (int)$item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Sticky Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">Ringkasan Belanja
                    </h2>

                    <div class="space-y-4 mb-6 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Harga Item</span>
                            <span class="font-bold text-gray-900" id="summary-grand-total">Rp {{
                                number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Biaya Pengiriman</span>
                            <span
                                class="font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded text-xs tracking-wide">GRATIS
                                (PROMO)</span>
                        </div>
                        <div class="border-t border-dashed border-gray-200 my-4"></div>
                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg">
                            <span class="text-base font-bold text-gray-900">Total Bayar</span>
                            <span class="text-2xl font-extrabold text-gray-900" id="sticky-grand-total">Rp {{
                                number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Check Out Button -->
                    <a href="{{ route('checkout.details') }}"
                        class="w-full bg-orange-600 hover:bg-orange-700 text-black font-bold py-4 rounded-xl shadow-md transition-all transform hover:-translate-y-1 block text-center flex items-center justify-center gap-2 group">
                        <span>Check Out</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    <div class="mt-6 text-center">
                        <p
                            class="text-[10px] text-gray-400 uppercase tracking-widest font-bold flex items-center justify-center gap-2">
                            <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Jaminan Keamanan Transaksi
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="py-24 text-center bg-white rounded-2xl shadow-sm border border-gray-100 max-w-2xl mx-auto">
            <div class="inline-block p-6 rounded-full bg-orange-50 mb-6 animate-pulse">
                <svg class="w-16 h-16 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Keranjang Belanja Kosong</h2>
            <p class="text-gray-500 mb-8 text-lg">Wah, keranjangmu masih kosong nih. Yuk isi dengan produk favoritmu!
            </p>
            <a href="{{ route('catalog.index') }}"
                class="inline-flex items-center bg-gray-900 text-white font-bold py-3 px-8 rounded-xl hover:bg-black transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Mulai Belanja
            </a>
        </div>
        @endif
    </div>
</div>

<script>
    // Format Rupiah Helper
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(number);
    };

    // Show Toast
    const showToast = (message, type = 'error') => {
        const container = document.getElementById('toast-container');
        const div = document.createElement('div');
        div.className = `px-6 py-4 rounded-lg shadow-lg border-l-4 transition-all duration-300 transform translate-y-5 opacity-0 flex items-center gap-3 ${type === 'error' ? 'bg-red-50 text-red-700 border-red-500' : 'bg-green-50 text-green-700 border-green-500'}`;
        div.innerHTML = `<span class="font-medium">\${message}</span>`;
        container.appendChild(div);

        requestAnimationFrame(() => {
            div.classList.remove('translate-y-5', 'opacity-0');
        });

        setTimeout(() => {
            div.classList.add('opacity-0', 'translate-y-5');
            setTimeout(() => div.remove(), 300);
        }, 3000);
    };

    // Update Quantity
    async function updateQty(id, change) {
        console.log(`Updating Qty for ID: ${id}, Change: ${change}`);
        const qtyInput = document.getElementById(`qty-${id}`);

        if (!qtyInput) {
            console.error(`Input element qty-${id} not found!`);
            return;
        }

        let currentQty = parseInt(qtyInput.value);
        if (isNaN(currentQty)) currentQty = 1;

        let newQty = currentQty + change;
        console.log(`Current: ${currentQty}, New: ${newQty}`);

        if (newQty < 1) return;

        // Optimistic UI Update
        qtyInput.value = newQty;

        try {
            const response = await fetch(`/cart/update/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: newQty })
            });

            console.log('Response status:', response.status);
            const data = await response.json();
            console.log('Response data:', data);

            if (!response.ok) {
                // Revert on failure
                qtyInput.value = currentQty;
                showToast(data.message || 'Gagal mengupdate keranjang.');
                return;
            }

            if (data.success) {
                const subRow = document.getElementById(`subtotal-${id}`);
                if (subRow) subRow.innerText = formatRupiah(data.itemTotal).replace('Rp', 'Rp ');

                const summaryTotal = document.getElementById('summary-grand-total');
                const stickyTotal = document.getElementById('sticky-grand-total');
                if (summaryTotal) summaryTotal.innerText = formatRupiah(data.grandTotal).replace('Rp', 'Rp ');
                if (stickyTotal) stickyTotal.innerText = formatRupiah(data.grandTotal).replace('Rp', 'Rp ');

                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.totalQty } }));

                // Update Badge if present
                const badge = document.getElementById('cart-count');
                if (badge) {
                    badge.innerText = data.totalQty;
                    badge.classList.remove('hidden');
                }
            }
        } catch (error) {
            console.error('Fetch Error:', error);
            qtyInput.value = currentQty; // Revert
            showToast('Terjadi kesalahan jaringan.');
        }
    }

    // Remove Item
    async function removeItem(id) {
        if (!confirm('Hapus produk ini dari keranjang?')) return;

        try {
            const response = await fetch(`/cart/remove/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const data = await response.json();

            if (data.success) {
                const row = document.getElementById(`item-row-${id}`);
                if (row) {
                    row.style.opacity = '0';
                    setTimeout(() => row.remove(), 300);
                }

                const summaryTotal = document.getElementById('summary-grand-total');
                const stickyTotal = document.getElementById('sticky-grand-total');
                if (summaryTotal) summaryTotal.innerText = formatRupiah(data.grandTotal).replace('Rp', 'Rp ');
                if (stickyTotal) stickyTotal.innerText = formatRupiah(data.grandTotal).replace('Rp', 'Rp ');

                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.totalQty } }));

                if (data.totalQty === 0) {
                    setTimeout(() => window.location.reload(), 500);
                }
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Gagal menghapus produk.');
        }
    }
</script>
@endsection