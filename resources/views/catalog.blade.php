@extends('layouts.app')

@section('title', 'Catalog')

@section('content')
<div class="bg-white py-12">
    <!-- Header -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
        <span class="text-xs font-bold tracking-[0.2em] text-gray-400 uppercase">KATALOG</span>
        <h1 class="font-serif text-4xl lg:text-5xl text-gray-900 mt-2 mb-4">Narita Lashes</h1>
        <p class="text-gray-500 text-sm max-w-xl mx-auto leading-relaxed">
            Temukan Berbagai Pilihan Bulu Mata Palsu Dengan Desain Eksklusif Yang Disesuaikan Untuk Setiap Gaya Dan
            Kebutuhan.
        </p>
        <div class="w-full h-px bg-narita-champagne mt-8"></div>
    </div>

    <!-- Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-16">
            @foreach($catalogs as $catalog)
            <div class="flex flex-col items-center group">
                <!-- Image -->
                <!-- Image -->
                <a href="{{ route('product.detail', $catalog->id) }}"
                    class="block w-full overflow-hidden rounded-lg mb-6 relative" style="aspect-ratio: 1/1;">
                    <img src="{{ asset($catalog->image) }}" alt="{{ $catalog->name }}"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500 ease-in-out">
                </a>

                <!-- Content -->
                <div class="text-center space-y-2 mb-6">
                    <a href="{{ route('product.detail', $catalog->id) }}"
                        class="block group-hover:text-narita-gold transition-colors">
                        <h3 class="font-sans text-xl font-medium text-gray-900">{{ $catalog->name }}</h3>
                    </a>
                    <p class="text-gray-900 font-bold">Rp {{ number_format($catalog->price, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500">Stock: {{ $catalog->stock }}</p>
                </div>

                <!-- Button -->
                <button onclick="addToCart({{ $catalog->id }}, this)"
                    class="inline-flex items-center justify-center px-8 py-3 bg-[#F7E7CE] hover:bg-[#F3E5DC] text-gray-800 text-xs font-bold tracking-widest uppercase rounded-lg transition-colors duration-300 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Add to Cart
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function addToCart(productId, btn) {
        const originalContent = btn.innerHTML;

        // Loading State
        btn.innerHTML = `<svg class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Adding...`;
        btn.disabled = true;

        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity: 1 })
        })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    // Success State
                    btn.innerHTML = `<span class="flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Added!</span>`;
                    btn.classList.add('bg-green-100', 'text-green-800');
                    btn.classList.remove('bg-[#F7E7CE]');

                    // Update global cart badge
                    const badge = document.querySelector('.cart-badge');
                    if (badge && data.cartCount) {
                        badge.innerText = data.cartCount;
                        badge.classList.remove('hidden');
                    }

                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('bg-green-100', 'text-green-800');
                        btn.classList.add('bg-[#F7E7CE]');
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