<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Narita Lashes</title>

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
    <!-- Fallback for direct serving -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'narita-nude': '#F3E5DC',
                        'narita-champagne': '#F7E7CE',
                        'narita-gold': '#D4AF37',
                        'narita-dark': '#1a1a1a',
                        'narita-text': '#4a4a4a',
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @endif

    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Inter', sans-serif;
        }

        .text-narita-gold {
            color: #D4AF37;
        }

        .bg-narita-gold {
            background-color: #D4AF37;
        }

        .border-narita-gold {
            border-color: #D4AF37;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-600 bg-white">

    <!-- Modern Sticky Navbar (Consistent with Welcome) -->
    <!-- Modern Sticky Navbar (Consistent with Welcome) -->
    <x-navbar />

    <!-- Main Content -->
    <main class="bg-white">
        <!-- Header Section with Collage -->
        <section class="max-w-7xl mx-auto px-6 py-16 lg:py-24">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-20">
                <!-- Title -->
                <div class="w-full lg:w-1/2 text-center lg:text-left">
                    <h1 class="font-serif text-5xl lg:text-7xl text-gray-800 font-bold mb-4">Hubungi Kami</h1>
                    <div class="h-1.5 w-24 bg-narita-gold rounded-full mx-auto lg:mx-0 opacity-80"></div>
                </div>

                <!-- Image Collage -->
                <div class="w-full lg:w-1/2 flex justify-center lg:justify-end gap-4 lg:gap-6">
                    <div class="w-1/3 aspect-[3/4] rounded-2xl overflow-hidden shadow-lg transform translate-y-8">
                        <img src="{{ asset('img/img1.png') }}" alt="Work 1" class="w-full h-full object-cover">
                    </div>
                    <div
                        class="w-1/3 aspect-[3/4] rounded-2xl overflow-hidden shadow-lg transform -translate-y-4 relative z-10 scale-110">
                        <img src="{{ asset('img/img2.png') }}" alt="Work 2" class="w-full h-full object-cover">
                    </div>
                    <div class="w-1/3 aspect-[3/4] rounded-2xl overflow-hidden shadow-lg transform translate-y-8">
                        <img src="{{ asset('img/img3.png') }}" alt="Work 3" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="w-full h-8 bg-[#F8DF8B]/30 my-12"></div>

        <!-- Contact Section -->
        <section class="max-w-4xl mx-auto px-6 py-16 text-center">
            <h2 class="font-serif text-4xl lg:text-5xl text-gray-800 font-bold mb-16">Say hi to us!</h2>

            <div class="flex flex-col md:flex-row justify-center items-center gap-12 md:gap-24 mb-20">
                <!-- Address -->
                <div class="flex items-start gap-4 text-left max-w-xs">
                    <div
                        class="w-12 h-12 flex-shrink-0 bg-[#F3E5DC] rounded-full flex items-center justify-center text-narita-gold">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-sans text-gray-500 leading-relaxed text-sm">
                            Jln. Kawedanan Lama, Sudagaran, Kec. Banyumas, Kab. Banyumas
                        </p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-center gap-4 text-left">
                    <div
                        class="w-12 h-12 flex-shrink-0 bg-[#F3E5DC] rounded-full flex items-center justify-center text-narita-gold">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-sans text-gray-600 font-medium">NaritaLashes@gmail.com</p>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            <div class="w-full relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                <iframe
                    src="https://maps.google.com/maps?q=F7MW%2BV4X%2C+Jl.+Kawedanan%2C+Banyumas%2C+Sudagaran%2C+Kec.+Banyumas%2C+Kabupaten+Banyumas%2C+Jawa+Tengah+53192&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-[400px] lg:h-[500px] grayscale hover:grayscale-0 transition-all duration-700">
                </iframe>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-6">
            <div class="border-t border-gray-100 my-10"></div>
        </div>
    </main>

    <!-- Footer (Consistent with Welcome) -->
    <footer class="bg-white pt-10 pb-12">
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
                        <!-- Social Icons -->
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-1.002.555-2.113.916-3.285 1.155a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </a>
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
                        <li><a href="{{ url('/') }}" class="hover:text-narita-gold transition-colors">Beranda</a></li>
                        <li><a href="/gallery" class="hover:text-narita-gold transition-colors">Gallery</a></li>
                        <li><a href="#" class="hover:text-narita-gold transition-colors">Tentang</a></li>
                        <li><a href="#" class="hover:text-narita-gold transition-colors">Kontak</a></li>
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

    <!-- Script for Navbar -->
    <script>
        // Vanilla JS for Mobile Menu
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

                mation
                iconHamburger.classList.add('opacity-0', 'rotate-90');
                iconClose.classList.remove('opacity-0', '-rotate-90');
                iconClose.classList.add('opacity-100', 'rotate-0');

                btn.setAttrnded', 'true');
            } else {
                // Close Menu
                overlay.classList.add('opacity-0', 'pointer-events-none');
                panel.classList.remove('translate-y-0', 'opacity-100');
                panel.classList.add('opacity-0', '-translate-y-10', 'pointer-events-none');

                // Icon Animation
                rger.classList.remove('opacity-0', 'rotate-90');
                iconClose.classList.remove('opacity-100', 'rotate-0');
                iconClose.classList.add('opacity-0', '-rotate-90');

                btn.setAttribute('aria-expanded', 'false');
            }

            btn.addEventListener('click', toggleMobileMenu);
    </script>
</body>

</html>