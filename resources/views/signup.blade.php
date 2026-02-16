<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account - Narita Lashes</title>

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

        .text-gold {
            color: #D4AF37;
        }

        .border-gold {
            border-color: #D4AF37;
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
                Create Account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-500 font-light">
                Join Narita Lashes for a premium experience
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('signup') }}" method="POST">
            @csrf

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            There were errors with your submission
                        </h3>
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

            <div class="space-y-4">
                <div>
                    <label for="name" class="sr-only">Full Name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                        class="appearance-none rounded-[20px] relative block w-full px-5 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#D4AF37] focus:border-[#D4AF37] focus:z-10 sm:text-sm transition-colors duration-300"
                        placeholder="Full Name" value="{{ old('name') }}">
                </div>

                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="appearance-none rounded-[20px] relative block w-full px-5 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#D4AF37] focus:border-[#D4AF37] focus:z-10 sm:text-sm transition-colors duration-300"
                        placeholder="Email address" value="{{ old('email') }}">
                </div>

                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="appearance-none rounded-[20px] relative block w-full px-5 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#D4AF37] focus:border-[#D4AF37] focus:z-10 sm:text-sm transition-colors duration-300"
                        placeholder="Password (min. 8 characters)">
                </div>

                <div>
                    <label for="password_confirmation" class="sr-only">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        autocomplete="new-password" required
                        class="appearance-none rounded-[20px] relative block w-full px-5 py-4 border border-gray-200 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-1 focus:ring-[#D4AF37] focus:border-[#D4AF37] focus:z-10 sm:text-sm transition-colors duration-300"
                        placeholder="Confirm Password">
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-bold rounded-[20px] text-white bg-gradient-to-r from-[#D4AF37] to-[#F58634] hover:from-[#c29d2b] hover:to-[#e07528] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#D4AF37] shadow-lg shadow-orange-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 transform uppercase tracking-wider">
                    Create Account
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('signin') }}"
                    class="font-medium text-[#F58634] hover:text-[#e07528] transition-colors">
                    Sign in
                </a>
            </p>
        </div>
    </div>

</body>

</html>