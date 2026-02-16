<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Work Gallery - Narita Lashes</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'narita-nude': '#F3E5DC',
                        'narita-champagne': '#F7E7CE',
                        'narita-gold': '#D4AF37',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    @endif

    <!-- Inline Style overrides -->
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Inter', sans-serif;
        }

        /* Fade in animation for images */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-600 bg-[#FDFBF7]">

    <!-- Modern Sticky Navbar -->
    <!-- Modern Sticky Navbar -->
    <x-navbar />


    <!-- Gallery Header Section -->
    <header class="pt-16 pb-12 text-center px-6">
        <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-gray-900 mb-4 animate-fade-in"
            style="animation-delay: 0.1s;">
            Our Work Gallery
        </h1>
        <p class="text-gray-500 font-light text-lg md:text-xl max-w-2xl mx-auto italic animate-fade-in"
            style="animation-delay: 0.2s;">
            A collection of our premium lash transformations.
        </p>
    </header>

    <!-- Filter Section -->
    <section class="max-w-7xl mx-auto px-6 mb-12">
        <div class="flex flex-wrap justify-center gap-3 md:gap-4 animate-fade-in" style="animation-delay: 0.3s;">
            <button onclick="filterGallery('all')"
                class="filter-btn active px-6 py-2 rounded-full text-sm tracking-wide border border-narita-gold bg-narita-gold text-white font-medium transition-all duration-300 hover:shadow-md">
                All
            </button>
            <button onclick="filterGallery('natural')"
                class="filter-btn px-6 py-2 rounded-full text-sm tracking-wide border border-gray-200 bg-white text-gray-500 font-medium hover:border-narita-gold hover:text-narita-gold transition-all duration-300 hover:shadow-md">
                Natural
            </button>
            <button onclick="filterGallery('volume')"
                class="filter-btn px-6 py-2 rounded-full text-sm tracking-wide border border-gray-200 bg-white text-gray-500 font-medium hover:border-narita-gold hover:text-narita-gold transition-all duration-300 hover:shadow-md">
                Volume
            </button>
            <button onclick="filterGallery('lamination')"
                class="filter-btn px-6 py-2 rounded-full text-sm tracking-wide border border-gray-200 bg-white text-gray-500 font-medium hover:border-narita-gold hover:text-narita-gold transition-all duration-300 hover:shadow-md">
                Eyelash Lamination
            </button>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="max-w-7xl mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">

            <!-- Item 1: Natural -->
            <div class="gallery-item group relative rounded-[20px] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer animate-fade-in"
                data-category="natural">
                <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                    <img src="{{ asset('img/img1.png') }}" alt="Natural Lash Extension"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                </div>
                <div
                    class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white text-sm font-medium tracking-widest uppercase">Natural Set</span>
                </div>
            </div>

            <!-- Item 2: Volume -->
            <div class="gallery-item group relative rounded-[20px] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer animate-fade-in"
                data-category="volume" style="animation-delay: 0.1s;">
                <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                    <img src="{{ asset('img/img2.png') }}" alt="Volume Lash Extension"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                </div>
                <div
                    class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white text-sm font-medium tracking-widest uppercase">Volume Set</span>
                </div>
            </div>

            <!-- Item 3: Lamination -->
            <div class="gallery-item group relative rounded-[20px] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer animate-fade-in"
                data-category="lamination" style="animation-delay: 0.2s;">
                <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                    <img src="{{ asset('img/img3.png') }}" alt="Lash Lamination"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                </div>
                <div
                    class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white text-sm font-medium tracking-widest uppercase">Lash Lamination</span>
                </div>
            </div>

            <!-- Item 4: Volume (Using Hero) -->
            <div class="gallery-item group relative rounded-[20px] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer animate-fade-in"
                data-category="volume" style="animation-delay: 0.3s;">
                <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                    <img src="{{ asset('img/hero.png') }}" alt="Premium Volume"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                </div>
                <div
                    class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white text-sm font-medium tracking-widest uppercase">Mega Volume</span>
                </div>
            </div>

            <!-- Item 5: Natural (Recycled Img 1) -->
            <div class="gallery-item group relative rounded-[20px] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer animate-fade-in"
                data-category="natural" style="animation-delay: 0.4s;">
                <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                    <img src="{{ asset('img/img1.png') }}" alt="Classic Natural"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                </div>
                <div
                    class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white text-sm font-medium tracking-widest uppercase">Classic Natural</span>
                </div>
            </div>

            <!-- Item 6: Lamination (Recycled Img 2) -->
            <div class="gallery-item group relative rounded-[20px] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer animate-fade-in"
                data-category="lamination" style="animation-delay: 0.5s;">
                <div class="aspect-[3/4] overflow-hidden bg-gray-100">
                    <img src="{{ asset('img/img2.png') }}" alt="Lash Lift"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out">
                </div>
                <div
                    class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/60 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="text-white text-sm font-medium tracking-widest uppercase">Lash Lift</span>
                </div>
            </div>

        </div>
    </section>

    <!-- Detailed Footer -->
    <footer class="bg-white pt-16 pb-12 border-t border-gray-100/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-20">
                <!-- Col 1: Socials & Disclaimer -->
                <div class="flex flex-col justify-between space-y-8 md:col-start-1 h-full">
                    <div>
                        <img src="{{ asset('img/logo.png') }}" alt="Narita Lashes" class="h-12 mb-6 opacity-90">
                        <p class="text-xs text-gray-400 font-medium leading-relaxed">© {{ date('Y') }} Narita
                            Lashes.<br>All rights reserved.</p>
                    </div>

                    <div class="flex space-x-4">
                        <!-- Facebook -->
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <!-- Twitter -->
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-1.002.555-2.113.916-3.285 1.155a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
                        <!-- Linkedin -->
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Take a Tour -->
                <div class="space-y-6">
                    <h4 class="font-bold text-gray-800 text-sm tracking-widest uppercase">Take a tour</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="/" class="hover:text-narita-gold transition-colors">Beranda</a></li>
                        <li><a href="/gallery" class="hover:text-narita-gold transition-colors">Gallery</a></li>
                        <li><a href="#" class="hover:text-narita-gold transition-colors">Tentang</a></li>
                        <li><a href="/contact" class="hover:text-narita-gold transition-colors">Kontak</a></li>
                        <li><a href="#" class="hover:text-narita-gold transition-colors">Blog</a></li>
                    </ul>
                </div>

                <!-- Col 3: Layanan -->
                <div class="space-y-6">
                    <h4 class="font-bold text-gray-800 text-sm tracking-widest uppercase">Layanan</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-narita-gold transition-colors">Bulu Mata</a></li>
                    </ul>
                </div>

                <!-- Col 4: Kontak -->
                <div class="space-y-6">
                    <h4 class="font-bold text-gray-800 text-sm tracking-widest uppercase">Kontak</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-narita-gold transition-colors">NaritaLashes@gmail.com</a></li>
                        <li><span class="block">+62 812 3456 7890</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Copy of Navbar Script
        const btn = document.getElementById('mobile-menu-btn');
        const overlay = document.getElementById('mobile-menu-overlay');
        const panel = document.getElementById('mobile-menu-panel');
        const iconHamburger = document.getElementById('icon-hamburger');
        const iconClose = document.getElementById('icon-close');
        let isMenuOpen = false;

        function toggleMobileMenu() {
            isMenuOpen = !isMenuOpen;

            if (isMenuOpen) {
                // Open Menu
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                panel.classList.remove('opacity-0', 'translate-y-[-20px]', 'pointer-events-none', '-translate-y-10');
                panel.classList.add('translate-y-0', 'opacity-100');

                // Icon Animation
                iconHamburger.classList.add('opacity-0', 'rotate-90');
                iconClose.classList.remove('opacity-0', '-rotate-90');
                iconClose.classList.add('opacity-100', 'rotate-0');

                btn.setAttribute('aria-expanded', 'true');
            } else {
                // Close Menu
                overlay.classList.add('opacity-0', 'pointer-events-none');
                panel.classList.remove('translate-y-0', 'opacity-100');
                panel.classList.add('opacity-0', '-translate-y-10', 'pointer-events-none');

                // Icon Animation
                iconHamburger.classList.remove('opacity-0', 'rotate-90');
                iconClose.classList.remove('opacity-100', 'rotate-0');
                iconClose.classList.add('opacity-0', '-rotate-90');

                btn.setAttribute('aria-expanded', 'false');
            }
        }

        btn.addEventListener('click', toggleMobileMenu);

        // Filter Script
        function filterGallery(category) {
            const items = document.querySelectorAll('.gallery-item');
            const buttons = document.querySelectorAll('.filter-btn');

            // Update Buttons
            buttons.forEach(btn => {
                const btnText = btn.innerText.toLowerCase().replace('eyelash ', '').replace('all', 'all'); // approximate logic
                if (btn.innerText.toLowerCase().includes(category) || (category === 'all' && btn.innerText.toLowerCase() === 'all')) {
                    // Activate
                    btn.classList.remove('bg-white', 'text-gray-500', 'border-gray-200');
                    btn.classList.add('bg-narita-gold', 'text-white', 'border-narita-gold');
                } else {
                    // Deactivate
                    btn.classList.remove('bg-narita-gold', 'text-white', 'border-narita-gold');
                    btn.classList.add('bg-white', 'text-gray-500', 'border-gray-200');
                }
            });

            // Special fix for simple logic above not handling complex button states identically to my class dump, 
            // but for a mocked robust check let's just query specifically.
            // Actually, simpler logic:

            // Reset all buttons to inactive style
            buttons.forEach(b => {
                b.classList.remove('bg-narita-gold', 'text-white', 'border-narita-gold');
                b.classList.add('bg-white', 'text-gray-500', 'border-gray-200');
            });

            // Set active button
            const activeBtn = Array.from(buttons).find(b => {
                if (category === 'all') return b.innerText.toLowerCase() === 'all';
                if (category === 'natural') return b.innerText.toLowerCase() === 'natural';
                if (category === 'volume') return b.innerText.toLowerCase() === 'volume';
                if (category === 'lamination') return b.innerText.toLowerCase().includes('lamination');
            });
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-gray-500', 'border-gray-200');
                activeBtn.classList.add('bg-narita-gold', 'text-white', 'border-narita-gold');
            }


            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                    // Re-trigger animation
                    item.classList.remove('animate-fade-in');
                    void item.offsetWidth; // trigger reflow
                    item.classList.add('animate-fade-in');
                } else {
                    item.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>