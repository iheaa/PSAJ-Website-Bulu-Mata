<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang - Narita Lashes</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
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

        .bg-narita-nude {
            background-color: #F3E5DC;
        }

        .bg-narita-champagne {
            background-color: #F7E7CE;
        }

        .text-narita-gold {
            color: #D4AF37;
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-600 bg-white">

    <x-navbar />

    <!-- About Content Section -->
   <main class="max-w-screen-lg mx-auto px-6 py-12 md:py-24 bg-white">


    <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-16">
        
        <div class="w-full flex justify-center mb-12">
            <div class="relative w-[90%] md:w-[85%] h-[280px] sm:h-[350px] md:h-[450px] rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('img/atas.png') }}" alt="Narita Lash Look" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="w-full md:w-[85%] text-left">
            <div class="mb-10">
                <h2 class="text-5xl md:text-6xl font-bold text-gray-800 font-sans tracking-tight mb-4">
                    Apa itu Eyelash ?
                </h2>
                <p class="text-2xl md:text-3xl text-gray-600 leading-relaxed text-base md:text-lg font-sans">
                    Eyelash adalah teknik pasang bulu mata dengan menempelkan bulu mata palsu pada bulu mata asli menggunakan perekat khusus. Hasilnya, bulu mata tampak lebih panjang, lebat, dan lentik alami tanpa perlu repot merias mata setiap hari. Wink! ;)
                </p>
            </div>

            <br>
            <br>

            <div>
                <h2 class="text-5xl md:text-6xl font-bold text-gray-800 font-sans tracking-tight mb-4">
                    Mengapa memilih Narita Lashes ?
                </h2>
                <p class="text-2xl md:text-3xl text-gray-600 leading-relaxed text-base md:text-lg font-sans">
                    Narita Lashes mengutamakan kualitas dalam setiap layanan. Setiap proses dilakukan dengan rapi, higienis <br> 
                    dan penuh ketelitian agar pelanggan merasa nyaman. Hasil eyelash extension disesuaikan dengan bentuk <br>
                    mata sehingga terlihat natural dan meningkatkan kepercayaan diri.
                </p>
            </div>
        </div>
        
    </div>
</main>

    <!-- #2 Section: Pilihan Style Eyelash -->
 <main class="max-w-screen-lg mx-auto px-6 py-20 bg-white">
        
    <div class="flex flex-col md:flex-row items-center lg:items-start gap-12 lg:gap-16">

        <!-- Image (Mobile: Atas | Desktop: Kanan) -->
        <div class="w-full md:w-1/2 relative lg:pl-8">
            
            <div class="relative w-[85%] md:w-[80%] ml-auto
                        h-[350px] sm:h-[450px] md:h-[500px]
                        rounded-lg shadow-md overflow-hidden">
                
                <img src="{{ asset('img/bawah.png') }}" 
                     alt="Narita Lash Models"
                     class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Text (Mobile: Bawah | Desktop: Kiri) -->
        <div class="w-full md:w-1/2 md:pr-8 text-left">

            <h2 class="text-3xl md:text-5xl font-bold text-gray-800 
                       tracking-tight mb-8 md:mb-10 leading-tight">
                Pilihan Style<br>Eyelash di Narita<br>Lashes
            </h2>

            <div class="space-y-6">

                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">
                        Classic Lashes
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tampilan rapi dan natural dengan hasil ringan, cocok untuk sehari-hari.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">
                        Volume Lashes
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Bulu mata terlihat lebih tebal dan penuh, memberi kesan lebih bold.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">
                        Natural Lashes
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Tampilan sederhana dan alami, seperti bulu mata asli yang lebih lentik.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">
                        Soft Wispy Lashes
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Bulu mata bervariasi panjangnya, memberi efek lembut dan manis.
                    </p>
                </div>

                <div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800 mb-1">
                        Doll Eye Lashes
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Fokus di bagian tengah mata, membuat mata terlihat lebih besar dan bulat.
                    </p>
                </div>

                <div class="pt-2">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-800">
                        Dan Lain-Lain
                    </h3>
                </div>

            </div>

        </div>

    </div>
</main>
    </div>
</main>
    <!-- Footer -->
    <footer class="bg-white pt-16 pb-12 border-t border-gray-100/50 mt-12 lg:mt-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-20">
                <!-- Col 1: Socials & Disclaimer -->
                <div class="flex flex-col justify-between space-y-8 md:col-start-1 h-full">
                    <div>
                        <img src="{{ asset('img/logo.png') }}" alt="Narita Lashes" class="h-12 mb-6 opacity-90">
                        <p class="text-xs text-gray-400 font-medium leading-relaxed">© {{ date('Y') }} Narita Lashes.<br>All rights reserved.</p>
                    </div>

                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-narita-gold transition-colors duration-300">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Take a Tour -->
                <div class="space-y-6">
                    <h4 class="font-bold text-gray-800 text-sm tracking-widest uppercase">Take a tour</h4>
                    <ul class="space-y-4 text-sm text-gray-500">
                        <li><a href="{{ url('/') }}" class="hover:text-narita-gold transition-colors">Beranda</a></li>
                        <li><a href="{{ url('/gallery') }}" class="hover:text-narita-gold transition-colors">Gallery</a></li>
                        <li><a href="{{ url('/tentang') }}" class="hover:text-narita-gold transition-colors">Tentang</a></li>
                        <li><a href="{{ url('/contact') }}" class="hover:text-narita-gold transition-colors">Kontak</a></li>
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
</body>
</html>
