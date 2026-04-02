<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - Narita Lashes</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

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

            <div class="flex flex-col md:flex-row justify-center items-center gap-8 md:gap-16 mb-20">
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
                    <div class="w-12 h-12 flex-shrink-0 bg-[#F3E5DC] rounded-full flex items-center justify-center text-narita-gold">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-sans text-gray-600 font-medium">NaritaLashes@gmail.com</p>
                    </div>
                </div>

                <!-- WhatsApp -->
               <div class="flex items-center gap-4 text-left">
                    <div class="w-12 h-12 flex-shrink-0 bg-[#F3E5DC] rounded-full flex items-center justify-center text-narita-gold">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
                        </svg>
                    </div>
                    <div class="whitespace-nowrap w-max min-w-max flex-shrink-0">
                        <p class="font-sans text-gray-600 font-medium whitespace-nowrap" style="white-space: nowrap;">+62 877-6477-8100</p>
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
                        <!-- Shopee -->
                        <a href="https://id.shp.ee/KQ37h6t" target="_blank" class="text-gray-400 hover:text-narita-gold transition-colors duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.14 11.45c-2.02-.45-2.73-.83-2.73-1.63 0-.67.66-1.12 1.6-1.12 1.14 0 2.22.42 2.76.67l.55-2.31c-.69-.32-1.89-.66-3.23-.66-2.52 0-4.32 1.34-4.32 3.51 0 2 .9 2.87 3.32 3.42 2.14.48 2.58 1.02 2.58 1.76 0 .86-.88 1.41-1.95 1.41-1.39 0-2.8-.57-3.41-.95l-.6 2.37c1.11.66 2.65 1.01 4.3 1.01 2.88 0 4.54-1.42 4.54-3.69-.02-1.95-1.07-2.9-3.41-3.79zm-7.69.04H6.5v-3.8h1.95v3.8zm11.23-8.8H4.32L2.6 7.64v10.95c0 .7.56 1.28 1.25 1.28h16.3c.7 0 1.25-.57 1.25-1.28V7.64l-1.72-4.95zm-3.81 12.06c-1.04.57-2.5.94-4.23.94-2.12 0-4.04-.6-5.46-1.61v-5.4c1.19 1.16 3.1 1.74 5.38 1.74 1.73 0 3.1-.34 4.14-.9nv5.2c.07.03.11.03.17.03z"/>
                            </svg>
                        </a>
                        <!-- WhatsApp -->
                        <a href="https://wa.me/6287764778100" target="_blank" class="text-gray-400 hover:text-narita-gold transition-colors duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
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
                        <li><span class="block">+62 877-6477-8100</span></li>
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