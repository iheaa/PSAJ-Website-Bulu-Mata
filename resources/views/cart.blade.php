@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/cart-enhanced.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="bg-gray-50 min-h-screen pb-32 pt-8 font-sans text-gray-800 cart-container">
    <div class="container mx-auto px-4 max-w-6xl">

        <!-- Toast Notification Area -->
        <div id="toast-container" class="fixed top-24 right-5 z-[150] space-y-4 pointer-events-none">
            @if(session('error'))
            <div
                class="pointer-events-auto bg-red-50 text-red-700 px-6 py-4 rounded-lg shadow-lg border-l-4 border-red-500 flex items-center gap-3 animate-fade-in-down">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
            @endif
        </div>

        <h1 class="text-5xl md:text-3xl font-bold text-gray-900 mb-4 font-sans">Keranjang Belanja</h1>
        <br>
        <br>

        @if(count($cart) > 0)
        <!-- Desktop Header -->
        <div class="hidden md:flex cart-header-row shadow-sm border border-gray-200">
            <div class="w-[5%] flex justify-center">
                <input type="checkbox" class="custom-checkbox text-orange-600 focus:ring-orange-500"
                    id="select-all-desktop" onchange="toggleAll(this.checked)">
            </div>
            <div class="w-[45%] pl-4 ml-4">Pilih Semua Produk</div>
        </div>

        <!-- Cart Items -->
        <div class="space-y-4">
            @foreach($cart as $item)
            <div class="cart-card p-4 md:p-6 relative group" id="item-row-{{ $item['id'] }}">
                <!-- Desktop Layout -->
                <div class="hidden md:flex items-center w-full ">

                    <!-- Checkbox -->
                    <div class="w-[5%] flex justify-center px-4">
                        <input type="checkbox"
                            class="item-checkbox custom-checkbox text-orange-600 focus:ring-orange-500"
                            data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}"
                            data-qty="{{ $item['quantity'] }}" checked onchange="calculateTotal()">
                    </div>

                    <!-- Product Info -->
                    <div class="w-[45%] flex items-center gap-6 pl-2">
                        <a href="{{ route('product.detail', $item['id']) }}"
                            class="cart-image-wrapper block w-24 h-24 flex-shrink-0 border border-gray-100">
                            <img src="{{ asset($item['image']) }}"
                                onerror="this.src='https://plus.unsplash.com/premium_photo-1679913792906-13ccc5c84d44?q=80&w=200&auto=format&fit=crop'"
                                alt="{{ $item['name'] }}">
                        </a>
                        <div class="flex-1 min-w-0 pr-4 ml-4">
                            <a href="{{ route('product.detail', $item['id']) }}" class="product-title line-clamp-2"
                                title="{{ $item['name'] }}">
                                {{ $item['name'] }}
                            </a>
                            <div class="mt-1">
                                <div class="product-variant">
                                    <span>Variasi: Default</span>


                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Unit Price -->
                    <div class="w-[15%] text-center price-text px-4">
                        Rp {{ number_format((int)$item['price'], 0, ',', '.') }}
                    </div>

                    <!-- Quantity -->
                    <div class="w-[15%] flex justify-center px-4">
                        <div class="qty-control shadow-sm">
                            <button type="button" onclick="updateQty({{ $item['id'] }}, -1)"
                                class="qty-btn hover:bg-gray-50">-</button>
                            <input type="number" id="qty-desktop-{{ $item['id'] }}" readonly
                                value="{{ $item['quantity'] }}" data-stock="{{ $item['stock'] ?? 999 }}"
                                class="qty-input">
                            <button type="button" onclick="updateQty({{ $item['id'] }}, 1)"
                                class="qty-btn hover:bg-gray-50">+</button>
                        </div>
                    </div>

                    <!-- Subtotal -->
                    <div class="w-[15%] text-center total-price-text ml-4" id="item-total-desktop-{{ $item['id'] }}">
                        Rp {{ number_format((int)$item['price'] * (int)$item['quantity'], 0, ',', '.') }}
                    </div>

                    <!-- Delete -->
                    <div class="w-[5%] flex items-center ml-4">

                        <button type="button" onclick="removeItem({{ $item['id'] }})" class="btn-delete"
                            title="Hapus Produk">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Layout -->
                <div class="flex gap-4 md:hidden">
                    <!-- Checkbox -->
                    <div class="flex-shrink-0 pt-8">
                        <input type="checkbox"
                            class="item-checkbox custom-checkbox text-orange-600 focus:ring-orange-500"
                            data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}"
                            data-qty="{{ $item['quantity'] }}" checked onchange="calculateTotal()">
                    </div>

                    <!-- Image -->
                    <a href="{{ route('product.detail', $item['id']) }}"
                        class="cart-image-wrapper w-24 h-24 flex-shrink-0 border border-gray-100 block">
                        <img src="{{ asset($item['image']) }}"
                            onerror="this.src='https://plus.unsplash.com/premium_photo-1679913792906-13ccc5c84d44?q=80&w=200&auto=format&fit=crop'"
                            alt="{{ $item['name'] }}">
                    </a>

                    <!-- Content -->
                    <div class="flex-1 min-w-0 flex flex-col justify-between py-1">
                        <div>
                            <h3 class="product-title text-sm line-clamp-2 md:text-base">{{ $item['name'] }}</h3>
                            <div class="product-variant text-xs mt-1">
                                <span>Default</span>
                            </div>
                            <div class="mt-2 text-orange-600 font-bold">
                                Rp {{ number_format((int)$item['price'], 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <!-- Qty -->
                            <div class="qty-control h-8 border-gray-300">
                                <button type="button" onclick="updateQty({{ $item['id'] }}, -1)"
                                    class="qty-btn h-full w-8 text-sm">-</button>
                                <input type="number" id="qty-mobile-{{ $item['id'] }}" readonly
                                    value="{{ $item['quantity'] }}" data-stock="{{ $item['stock'] ?? 999 }}"
                                    class="qty-input h-full w-10 text-sm">
                                <button type="button" onclick="updateQty({{ $item['id'] }}, 1)"
                                    class="qty-btn h-full w-8 text-sm">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Sticky Checkout Bar -->
        <div class="checkout-bar">
            <div class="container mx-auto max-w-6xl px-4 flex items-center justify-between">

                <!-- Left: Select All -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" class="custom-checkbox text-orange-600 focus:ring-orange-500"
                        id="select-all-mobile" onchange="toggleAll(this.checked)">
                    <label for="select-all-mobile"
                        class="text-sm font-medium text-gray-700 cursor-pointer select-none ml-4">
                        Pilih Semua Produk <span class="hidden sm:inline">({{ count($cart) }})</span>
                    </label>

                </div>

                <!-- Right: Total & Action -->
                <div class="flex items-center gap-4 md:gap-8">
                    <div class="text-right">
                        <div class="flex flex-col md:flex-row md:items-center md:gap-2">
                            <span class="text-lg md:text-2xl text-gray-500">Total Pembayaran : </span>
                            <span class="text-lg md:text-2xl font-bold text-orange-600" id="grand-total-display">
                                Rp {{ number_format($grandTotal, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-[10px] md:text-xs text-green-600 mt-0.5 hidden md:block font-medium">
                            Ongkir Di Tanggung Penjual
                        </div>
                    </div>

                    <a href="{{ route('checkout.details') }}" class="checkout-btn text-sm md:text-base">
                        Checkout
                    </a>
                </div>
            </div>
        </div>

        <!-- Spacer for sticky bar -->
        <div class="h-6"></div>

        @else
        <!-- Empty State -->
        <div
            class="flex flex-col items-center justify-center py-24 bg-white mx-4 rounded-xl shadow-sm border border-gray-100">
            <div class="w-40 h-40 bg-orange-50 rounded-full flex items-center justify-center mb-6 animate-pulse">
                <svg class="w-20 h-20 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2 font-sans">Keranjang Belanja Kosong</h2>
            <br>
            <p class="text-gray-500 mb-8 max-w-md text-center">Sepertinya Anda belum menambahkan produk apapun. Yuk
                telusuri katalog kami!</p>
            <br>
            <a href="{{ route('catalog.index') }}"
                class="bg-[#ee4d2d] text-lg font-bold py-3 px-10 rounded-full hover:bg-[#d73211] transition-all shadow-lg uppercase tracking-wider hover:-translate-y-1">
                Mulai Belanja
            </a>
        </div>
        @endif

    </div>
</div>

<script>
    // Constants
    const CSRF_TOKEN = '{{ csrf_token() }}';

    // Format Rupiah
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
        div.className = `pointer-events-auto px-6 py-4 rounded-lg shadow-lg border-l-4 transition-all duration-300 transform translate-y-5 opacity-0 flex items-center gap-3 ${type === 'error' ? 'bg-red-50 text-red-700 border-red-500' : 'bg-green-50 text-green-700 border-green-500'}`;
        div.innerHTML = `<span class="font-medium">${message}</span>`;
        container.appendChild(div);

        requestAnimationFrame(() => div.classList.remove('translate-y-5', 'opacity-0'));

        setTimeout(() => {
            div.classList.add('opacity-0', 'translate-y-5');
            setTimeout(() => div.remove(), 300);
        }, 3000);
    };

    // Checkbox Logic
    function toggleAll(checked) {
        // Select all checkboxes
        document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = checked);

        // Sync desktop/mobile select all
        const desktop = document.getElementById('select-all-desktop');
        const mobile = document.getElementById('select-all-mobile');
        if (desktop) desktop.checked = checked;
        if (mobile) mobile.checked = checked;

        calculateTotal();
    }

    // Sync individual checkboxes (Desktop <-> Mobile)
    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('item-checkbox')) {
            const id = e.target.getAttribute('data-id');
            const checked = e.target.checked;

            // Find all checkboxes for this ID and sync them
            document.querySelectorAll(`.item-checkbox[data-id="${id}"]`).forEach(cb => {
                if (cb !== e.target) {
                    cb.checked = checked;
                }
            });

            // Check if "Select All" should be updated
            updateSelectAllState();

            calculateTotal();
        }
    });

    function updateSelectAllState() {
        const checkboxes = Array.from(document.querySelectorAll('.item-checkbox'));
        if (checkboxes.length === 0) return;

        // Group by ID to treat desktop/mobile pair as one item
        const items = {};
        checkboxes.forEach(cb => {
            const id = cb.getAttribute('data-id');
            if (!items[id]) items[id] = true;
            if (!cb.checked) items[id] = false;
        });

        const allChecked = Object.values(items).every(status => status === true);

        const desktopSelectAll = document.getElementById('select-all-desktop');
        const mobileSelectAll = document.getElementById('select-all-mobile');

        if (desktopSelectAll) desktopSelectAll.checked = allChecked;
        if (mobileSelectAll) mobileSelectAll.checked = allChecked;
    }

    function calculateTotal() {
        let total = 0;
        let count = 0;
        const processedIds = new Set();

        // Iterate only checked checkboxes
        const checkedBoxes = document.querySelectorAll('.item-checkbox:checked');

        checkedBoxes.forEach(cb => {
            const id = cb.getAttribute('data-id');

            if (!processedIds.has(id)) {
                // Parse float/int explicitly
                const price = parseFloat(cb.getAttribute('data-price'));
                const qty = parseInt(cb.getAttribute('data-qty'));

                if (!isNaN(price) && !isNaN(qty)) {
                    total += price * qty;
                    count++;
                }

                processedIds.add(id);
            }
        });

        // Update Display
        const grandTotalEl = document.getElementById('grand-total-display');
        const selectedCountEl = document.getElementById('selected-count');
        const totalItemsCountEl = document.getElementById('total-items-count');

        if (grandTotalEl) grandTotalEl.innerText = formatRupiah(total).replace('Rp', 'Rp ');
        if (selectedCountEl) selectedCountEl.innerText = count;

        // Count total unique items for "Select All" label
        const allUniqueIds = new Set();
        document.querySelectorAll('.item-checkbox').forEach(cb => allUniqueIds.add(cb.getAttribute('data-id')));
        if (totalItemsCountEl) totalItemsCountEl.innerText = allUniqueIds.size;
    }

    // Update Quantity
    async function updateQty(id, change) {
        // Get Elements (Desktop & Mobile)
        const desktopInput = document.getElementById(`qty-desktop-${id}`);
        const mobileInput = document.getElementById(`qty-mobile-${id}`);
        const inputs = [desktopInput, mobileInput].filter(el => el !== null);

        if (inputs.length === 0) return;

        // Verify current value from the first valid input
        let currentQty = parseInt(inputs[0].value);
        if (isNaN(currentQty)) currentQty = 1;

        // Limit Check
        const stockAttr = inputs[0].getAttribute('data-stock');
        const stock = stockAttr ? parseInt(stockAttr) : 999;

        // Calculate New Qty
        let newQty = currentQty + change;

        // Validation
        if (newQty < 1) return; // Min 1
        if (newQty > stock) {
            showToast(`Maaf, stok hanya tersisa ${stock}`);
            return;
        }

        // 1. Optimistic UI Update: Inputs
        inputs.forEach(input => input.value = newQty);

        // 2. Optimistic UI Update: Checkboxes (Data Attributes on ALL instances)
        const checkboxes = document.querySelectorAll(`.item-checkbox[data-id="${id}"]`);
        let price = 0;

        checkboxes.forEach(cb => {
            cb.setAttribute('data-qty', newQty);
            price = parseFloat(cb.getAttribute('data-price')); // Capture price
        });

        // 3. Optimistic UI Update: Item Subtotal
        const newSubtotal = price * newQty;
        const subtotalEl = document.getElementById(`item-total-desktop-${id}`);
        if (subtotalEl) {
            subtotalEl.innerText = formatRupiah(newSubtotal).replace('Rp', 'Rp ');
        }

        // 4. Recalculate Grand Total immediately
        calculateTotal();

        // 5. Send to Server
        try {
            const response = await fetch(`/cart/update/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({ quantity: newQty })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'Gagal update keranjang.');
            }

            if (data.success) {
                // Success: Sync navbar cart count if returned
                if (data.totalQty !== undefined) {
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.totalQty } }));
                }
            }
        } catch (error) {
            console.error('Fetch Error:', error);
            showToast(error.message || 'Kesalahan jaringan.');

            // Revert on error
            inputs.forEach(input => input.value = currentQty);
            checkboxes.forEach(cb => cb.setAttribute('data-qty', currentQty));
            if (subtotalEl) {
                subtotalEl.innerText = formatRupiah(price * currentQty).replace('Rp', 'Rp ');
            }
            calculateTotal();
        }
    }

    // Remove Item
    async function removeItem(id) {
        if (!confirm('Hapus produk ini dari keranjang?')) return;

        try {
            const response = await fetch(`/cart/remove/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
            });

            const data = await response.json();

            if (data.success) {
                const row = document.getElementById(`item-row-${id}`);
                if (row) {
                    // Visual removal animation
                    row.style.opacity = '0';
                    row.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        row.remove();
                        // Re-calculate totals after removal
                        calculateTotal();

                        // Check if empty
                        const remainingRows = document.querySelectorAll(`[id^="item-row-"]`);
                        if (remainingRows.length === 0) {
                            window.location.reload();
                        }
                    }, 300);
                }

                if (data.totalQty !== undefined) {
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.totalQty } }));
                }
            } else {
                showToast(data.message || 'Gagal hapus produk.');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Gagal hapus produk.');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        calculateTotal();
    });
</script>
@endsection