<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Narita Lashes - Premium Eyelash Extensions</title>
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
    <!-- Fallback for direct serving if needed, though Vite is preferred -->
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

    <!-- Inline Style for specific tailwind overrides if build process is not modifying app.css immediately -->
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Inter', sans-serif;
        }

        .bg-narita-nude {
            background-color: #F3E5DC;
        }

        .bg-narita-champagne {
            background-color: #F7E7CE;
        }

        .bg-narita-gold {
            background-color: #D4AF37;
        }

        .text-narita-gold {
            color: #D4AF37;
        }

        .border-narita-gold {
            border-color: #D4AF37;
        }

        .hover-bg-narita-gold:hover {
            background-color: #D4AF37;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-600 bg-white">

    <!-- Modern Sticky Navbar -->
    <!-- Modern Sticky Navbar -->
    <x-navbar />


    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12" data-aos="fade-up">
        <div
            class="bg-narita-champagne bg-opacity-40 rounded-[3rem] lg:rounded-[4rem] p-8 lg:p-12 flex flex-col-reverse lg:flex-row items-center gap-12 relative overflow-hidden">

            <!-- Decorative Elements -->
            <div
                class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white opacity-20 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-narita-gold opacity-10 rounded-full blur-3xl pointer-events-none">
            </div>

            <!-- Left Content -->
            <div class="w-full lg:w-1/2 space-y-8 relative z-10 text-center lg:text-left" data-aos="fade-up" data-aos-delay="100">
                <!-- Logo Mark (Optional smaller logo or badge) -->
                <div class="flex justify-center lg:justify-start">
                    <img src="{{ asset('img/logo.png') }}" alt="" class="h-24 opacity-80" data-aos="zoom-in" data-aos-delay="200">
                </div>

                <h1 class="font-serif text-4xl lg:text-6xl text-gray-800 leading-tight">
                    <span class="block text-lg font-sans tracking-[0.2em] text-gray-500 uppercase mb-4">Timeless
                        Beauty</span>
                    kami bantu wujudkan <br>
                    <span class="text-gray-900">Bulu Mata Lentik</span> <br>
                    <span class="italic text-gray-600 font-light">Dan Eksotis</span>
                </h1>

                <p class="text-gray-600 max-w-md mx-auto lg:mx-0 leading-relaxed">
                    Rasakan sentuhan kemewahan dalam setiap helai. Kami menghadirkan ekstensi bulu mata premium yang
                    dirancang khusus untuk menonjolkan kecantikan alami mata Anda.
                </p>

                <div class="pt-4">
                    <a href="/catalog"
                        class="inline-block bg-[#E88D36] text-white px-10 py-4 rounded-xl font-medium shadow-lg shadow-orange-200 hover:shadow-xl hover:-translate-y-1 transition duration-300 ease-out text-lg">
                        Buy Now
                    </a>
                </div>
            </div>

            <!-- Right Image -->
            <div class="w-full lg:w-1/2 relative z-10" data-aos="fade-up" data-aos-delay="200">
                <div class="relative group">
                    <!-- Image Container -->
                    <div class="overflow-hidden rounded-[2.5rem] lg:rounded-[3rem] shadow-2xl border-4 border-white/50">
                        <img src="{{ asset('img/hero.png') }}" alt="Narita Lashes Treatment"
                            class="w-full h-[400px] lg:h-[500px] object-cover object-center transform group-hover:scale-105 transition duration-700 ease-in-out">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="max-w-7xl mx-auto px-6 py-20 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 items-center">

            <!-- Column 1: Title & Decorative -->
            <div class="lg:col-span-5 text-center lg:text-right space-y-6" data-aos="fade-up">
                <span class="text-narita-gold font-bold tracking-[0.2em] uppercase text-sm">Our Story</span>
                <h2 class="font-serif text-4xl md:text-5xl text-gray-900 leading-tight">
                    About Me
                </h2>
                <div class="h-1 w-24 bg-narita-gold mx-auto lg:ml-auto rounded-full"></div>
            </div>

            <!-- Column 2: Content -->
            <div class="lg:col-span-7" data-aos="fade-up" data-aos-delay="150">
                <p class="text-lg text-gray-600 leading-loose font-light">
                    Narita Lashes adalah brand bulu mata premium yang menghadirkan keindahan alami dan kenyamanan dalam
                    setiap produk. Kami menyediakan berbagai pilihan bulu mata berkualitas tinggi yang ringan, lentik,
                    dan cocok untuk berbagai gaya, baik untuk aktivitas sehari-hari maupun acara spesial. Narita Lashes
                    hadir untuk membantu Anda tampil lebih percaya diri dengan kecantikan yang elegan.
                </p>

                <div class="mt-8 flex items-center justify-center lg:justify-start space-x-4">
                    <span class="h-px w-12 bg-gray-300"></span>
                    <span class="font-serif italic text-gray-400">Narita Lashes Owner</span>
                </div>
            </div>

        </div>
    </section>

    <!-- Divider -->
    <div class="max-w-7xl mx-auto px-6">
        <div class="border-t border-gray-200"></div>
    </div>

    <!-- Lash Service Section -->
    <section class="max-w-7xl mx-auto px-6 py-24 bg-white">
        <!-- Header -->
        <div class="text-center mb-20 space-y-4" data-aos="fade-up">
            <span class="text-narita-gold font-bold tracking-[0.2em] uppercase text-xs">Our Services</span>
            <h2 class="font-serif text-4xl lg:text-5xl text-gray-900 leading-tight">Lash Service</h2>
            <p class="text-gray-500 font-light text-lg max-w-2xl mx-auto">Kami melayani jasa eyelash extension
                profesional dan berkualitas untuk menunjang penampilan Anda.</p>
        </div>

        <!-- Service Cards (Modern System) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Card 1 -->
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                <div
                    class="relative overflow-hidden rounded-[20px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_60px_rgba(0,0,0,0.08)] transition-all duration-500 bg-white transform hover:-translate-y-1">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('img/img1.png') }}" alt="Eyelash Extensions"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">
                    </div>
                </div>
                <div class="mt-6 text-center space-y-2">
                    <h3
                        class="text-xl font-sans font-semibold text-gray-800 group-hover:text-narita-gold transition-colors">
                        Eyelash
                        Extensions</h3>
                    <p class="text-sm text-gray-400 font-light">Natural & Volume Sets</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                <div
                    class="relative overflow-hidden rounded-[20px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_60px_rgba(0,0,0,0.08)] transition-all duration-500 bg-white transform hover:-translate-y-1">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('img/img2.png') }}" alt="Eyelash Lamination"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">
                    </div>
                </div>
                <div class="mt-6 text-center space-y-2">
                    <h3
                        class="text-xl font-sans font-semibold text-gray-800 group-hover:text-narita-gold transition-colors">
                        Eyelash
                        Lamination</h3>
                    <p class="text-sm text-gray-400 font-light">Lift & Tint Treatment</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="500">
                <div
                    class="relative overflow-hidden rounded-[20px] shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_60px_rgba(0,0,0,0.08)] transition-all duration-500 bg-white transform hover:-translate-y-1">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="{{ asset('img/img3.png') }}" alt="Eyelash Removal"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 ease-in-out">
                    </div>
                </div>
                <div class="mt-6 text-center space-y-2">
                    <h3
                        class="text-xl font-sans font-semibold text-gray-800 group-hover:text-narita-gold transition-colors">
                        Eyelash
                        Removal</h3>
                    <p class="text-sm text-gray-400 font-light">Safe & Gentle</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA Banner -->
    <section class="max-w-7xl mx-auto px-4 md:px-6 mt-32 mb-24" data-aos="zoom-in-up">
        <div
            class="relative rounded-[3rem] bg-gradient-to-r from-sky-50 to-blue-50 overflow-hidden px-8 py-16 md:px-16 md:py-24 flex items-center justify-between">
            <!-- Text Content -->
            <div class="w-full md:w-1/2 relative z-10 space-y-8" data-aos="fade-up" data-aos-delay="100">
                <h2 class="font-bold text-3xl md:text-4xl lg:text-5xl text-gray-800 leading-tight tracking-tight">
                    Tampilkan Pesona Mata <br> Terindahmu Bersama <br> Narita Lashes
                </h2>
                <p class="text-gray-500 max-w-md leading-relaxed text-lg">
                    Kami hadir untuk membantu Anda mendapatkan bulu mata lentik, rapi, dan elegan yang meningkatkan rasa
                    percaya diri di setiap kesempatan.
                </p>
                <div class="pt-6">
                    <a href="/catalog"
                        class="inline-block bg-[#F58634] text-white px-10 py-4 rounded-xl font-bold text-sm tracking-widest uppercase shadow-lg shadow-orange-200/50 hover:shadow-xl hover:-translate-y-1 transition transform duration-300">
                        Buy Now
                    </a>
                </div>
            </div>

            <!-- Image (Blended) -->
            <div class="absolute -right-10 top-0 bottom-0 w-3/5 hidden md:block pointer-events-none">
                <!-- Enhanced Gradient Mask -->
                <div class="absolute inset-0 z-10 bg-gradient-to-r from-sky-50 via-transparent to-transparent"></div>
                <img src="{{ asset('img/footer1.png') }}"
                    class="w-full h-full object-cover object-center opacity-95 mix-blend-multiply"
                    style="-webkit-mask-image: linear-gradient(to right, transparent 5%, black 40%); mask-image: linear-gradient(to right, transparent 5%, black 40%);">
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
                        <li><a href="#" class="hover:text-narita-gold transition-colors">Beranda</a></li>
                        <li><a href="#" class="hover:text-narita-gold transition-colors">Gallery</a></li>
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
    </script>