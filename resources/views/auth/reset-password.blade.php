<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - Narita Lashes</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .font-sans {
            font-family: 'Inter', sans-serif;
        }

        .bg-cream {
            background-color: #FDFBF7;
        }
    </style>
</head>

<body
    class="font-sans antialiased text-gray-600 bg-cream min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div
        class="max-w-md w-full space-y-8 bg-white p-10 rounded-[20px] shadow-[0_20px_60px_rgba(0,0,0,0.05)] border border-gray-100">
        <!-- Logo -->
        <div class="flex justify-center">
            <a href="/">
                <img src="{{ asset('img/logo.png') }}" alt="Narita Lashes" class="h-24 w-auto object-contain">
            </a>
        </div>

        <div>
            <h2 class="mt-6 text-center text-3xl font-serif text-gray-900">
                Buat Password Baru
            </h2>
            <p class="mt-2 text-center text-sm text-gray-500 font-light">
                Silakan buat password baru untuk akun Anda
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf

            <input type="hidden" name="email" value="{{ $email }}">

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md mb-6">
                <div class="flex">
                    <div class="ml-3">
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-md mb-6">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="password" class="sr-only">Password Baru</label>
                    <input id="password" name="password" type="password" required
                        class="appearance-none rounded-[20px] relative block w-full px-5 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#D4AF37] focus:border-[#D4AF37] focus:z-10 sm:text-sm transition-colors duration-300"
                        placeholder="Password Baru (min. 8 karakter)">
                </div>
                <div>
                    <label for="password_confirmation" class="sr-only">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="appearance-none rounded-[20px] relative block w-full px-5 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#D4AF37] focus:border-[#D4AF37] focus:z-10 sm:text-sm transition-colors duration-300"
                        placeholder="Konfirmasi Password Baru">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-[20px] text-white bg-gradient-to-r from-[#D4AF37] to-[#F58634] hover:from-[#c29d2b] hover:to-[#e07528] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37] shadow-lg shadow-orange-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 transform tracking-wider">
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>

</body>

</html>
