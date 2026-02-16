@extends('layouts.app')

@section('title', $product->name . ' - Narita Lashes')

@section('content')
<div class="bg-white min-h-screen pt-12 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Back Button -->
        <div class="mb-10">
            <a href="{{ route('catalog.index') }}"
                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-narita-gold transition-colors group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Catalog
            </a>
        </div>

        <br>
        <br>


        <!-- Main Product Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-start mb-24">
            <!-- Left Column: Product Image -->
            <div class="w-full">
                <div
                    class="w-full max-w-md mx-auto aspect-square bg-gray-50 rounded-xl overflow-hidden shadow-sm border border-gray-100 relative group">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover transform transition-transform duration-700 ease-in-out group-hover:scale-105">
                </div>
            </div>

            <!-- Right Column: Product Details -->
            <div class="flex flex-col space-y-8 text-left">
                <!-- Title -->
                <h1 class="font-sans text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- Price & Stock -->
                <div class="flex flex-col space-y-3">
                    <p class="font-serif text-3xl text-narita-gold font-bold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <div>
                        @if($product->stock > 0)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800 tracking-wide uppercase">
                            In Stock
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 tracking-wide uppercase">
                            Out of Stock
                        </span>
                        @endif
                    </div>
                </div>

                <div class="w-full h-px bg-gray-100"></div>

                <!-- Action Area -->
                <div class="space-y-6">
                    <div class="flex flex-col space-y-4">
                        <label class="text-xs font-bold text-gray-900 uppercase tracking-widest">Quantity</label>

                        <div class="flex flex-wrap items-center gap-6">
                            <!-- Compact Quantity Selector -->
                            <div
                                class="flex items-center border border-gray-300 rounded-lg h-12 w-auto bg-white shadow-sm hover:border-gray-400 transition-colors">
                                <button onclick="decrementQty()"
                                    class="px-4 h-full text-gray-500 hover:text-black hover:bg-gray-50 rounded-l-lg transition-colors focus:outline-none flex items-center justify-center cursor-pointer">
                                    -
                                </button>
                                <input type="number" id="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="w-12 h-full text-center border-none focus:ring-0 p-0 text-gray-900 font-semibold bg-transparent appearance-none text-base">
                                <button onclick="incrementQty()"
                                    class="px-4 h-full text-gray-500 hover:text-black hover:bg-gray-50 rounded-r-lg transition-colors focus:outline-none flex items-center justify-center cursor-pointer">
                                    +
                                </button>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-4 flex-1 max-w-lg">
                                <!-- Add to Cart (Icon Only) -->
                                <button onclick="addToCart({{ $product->id }})"
                                    class="flex-1 px-6 h-12 bg-narita-gold font-bold uppercase tracking-widest text-xs hover:bg-[#c29d2b] transition-all shadow-md hover:shadow-lg rounded-lg flex items-center justify-center group whitespace-nowrap transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </button>


                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 pl-1">
                        {{ $product->stock }} items available from Narita Lashes
                    </p>
                </div>
            </div>
        </div>

        <!-- Full Width Description Section with Improved Typography -->
        <div class="border-t border-gray-100 pt-16 max-w-5xl mx-auto">
            <h3 class="font-serif text-4xl font-bold text-gray-900 mb-8 pb-4 border-b border-gray-200 inline-block">
                Description </h3>

            <br>
            <br>


            <div class="prose prose-lg text-gray-600 max-w-none leading-relaxed">
                <p class="mb-6">{{ $product->description }}</p>

                <div class="border-t border-gray-100 pt-16 max-w-5xl mx-auto">
                    <h4
                        class="font-serif text-4xl font-bold text-gray-900 mb-8 pb-4 border-b border-gray-200 inline-block">
                        Product Specifications</h4>

                    <br>
                    <br>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-narita-gold rounded-full"></span>
                            <span class="font-medium text-gray-900">Material:</span>
                            <span class="text-gray-600">Premium Synthetic Fiber</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-narita-gold rounded-full"></span>
                            <span class="font-medium text-gray-900">Style:</span>
                            <span class="text-gray-600">Natural & Lightweight</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-narita-gold rounded-full"></span>
                            <span class="font-medium text-gray-900">Wear:</span>
                            <span class="text-gray-600">Reusable up to 20x</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <span class="w-2 h-2 bg-narita-gold rounded-full"></span>
                            <span class="font-medium text-gray-900">Origin:</span>
                            <span class="text-gray-600">Handmade in Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function incrementQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.getAttribute('max'));
        let val = parseInt(input.value);
        if (val < max) {
            input.value = val + 1;
        } else {
            alert('Barang sudah mencapai Stock (' + max + ')');
        }
    }

    function decrementQty() {
        const input = document.getElementById('quantity');
        let val = parseInt(input.value);
        if (val > 1) {
            input.value = val - 1;
        }
    }

    function addToCart(productId) {
        const qty = document.getElementById('quantity').value;
        const btn = event.currentTarget;
        const originalContent = btn.innerHTML;

        // Loading State
        btn.innerHTML = `<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>`;
        btn.disabled = true;

        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity: qty })
        })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    // Success State
                    btn.innerHTML = `<span class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Added!</span>`;
                    btn.classList.add('bg-green-600', 'hover:bg-green-700');
                    btn.classList.remove('bg-narita-gold', 'hover:bg-[#c29d2b]');

                    // Update global cart badge
                    const badge = document.querySelector('.cart-badge');
                    if (badge && data.cartCount) {
                        badge.innerText = data.cartCount;
                        badge.classList.remove('hidden');
                    }

                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('bg-green-600', 'hover:bg-green-700');
                        btn.classList.add('bg-narita-gold', 'hover:bg-[#c29d2b]');
                    }, 2000);
                } else {
                    alert(data.message || 'Failed to add to cart.');
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                btn.innerHTML = originalContent;
                btn.disabled = false;
                alert('An error occurred. Please try again.');
            });
    }
</script>
@endsection