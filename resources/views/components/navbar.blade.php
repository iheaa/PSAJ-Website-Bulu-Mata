<nav
    class="sticky top-0 z-[100] w-full transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100/50 supports-[backdrop-filter]:bg-white/60">
    <div class="w-full px-2 md:px-6 lg:px-12">
        <div class="flex justify-between items-center h-24 md:h-32 relative">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center relative z-[110]">
                <a href="{{ url('/') }}" class="group">
                    <img src="{{ asset('img/logo.png') }}" alt="Narita Lashes"
                        class="h-16 md:h-24 lg:h-28 w-auto object-contain transition transform duration-300 group-hover:scale-105">
                </a>
            </div>

            <!-- Desktop Menu (Centered Extended Pill) -->
            <div
                class="hidden md:flex transform -translate-x-1/2 items-center space-x-1 lg:space-x-2 bg-gray-50/80 px-4 py-2 rounded-full border border-gray-100 shadow-sm z-[110]">

                <!-- Counterweight for Balance (Invisible) - Ensures Links are perfectly centered -->
                <div class="flex items-center justify-center w-9 h-9 invisible" aria-hidden="true"></div>
                <div class="h-5 w-px mx-2 invisible" aria-hidden="true"></div>

                <a href="{{ url('/') }}"
                    class="px-4 py-2 text-xs lg:text-sm {{ request()->is('/') ? 'font-semibold text-narita-gold bg-white shadow-sm' : 'font-medium text-gray-500 hover:text-narita-gold hover:bg-white/50' }} tracking-wider uppercase rounded-full transition-all duration-300">Beranda</a>
                <a href="{{ url('/gallery') }}"
                    class="px-4 py-2 text-xs lg:text-sm {{ request()->is('gallery') ? 'font-semibold text-narita-gold bg-white shadow-sm' : 'font-medium text-gray-500 hover:text-narita-gold hover:bg-white/50' }} tracking-wider uppercase rounded-full transition-all duration-300">Gallery</a>
                <a href="{{ route('catalog.index') }}"
                    class="px-4 py-2 text-xs lg:text-sm {{ request()->routeIs('catalog.index') ? 'font-semibold text-narita-gold bg-white shadow-sm' : 'font-medium text-gray-500 hover:text-narita-gold hover:bg-white/50' }} tracking-wider uppercase rounded-full transition-all duration-300">Katalog</a>
                <a href="{{ url('/tentang') }}"
                    class="px-4 py-2 text-xs lg:text-sm {{ request()->is('tentang') ? 'font-semibold text-narita-gold bg-white shadow-sm' : 'font-medium text-gray-500 hover:text-narita-gold hover:bg-white/50' }} tracking-wider uppercase rounded-full transition-all duration-300">Tentang</a>
                <a href="{{ url('/contact') }}"
                    class="px-4 py-2 text-xs lg:text-sm {{ request()->is('contact') ? 'font-semibold text-narita-gold bg-white shadow-sm' : 'font-medium text-gray-500 hover:text-narita-gold hover:bg-white/50' }} tracking-wider uppercase rounded-full transition-all duration-300">Kontak</a>

                <!-- Divider between Link and Cart -->
                <div class="h-5 w-px bg-gray-200 mx-2"></div>

                <!-- Shopping Cart (Inside Pill) -->
                <a href="{{ route('cart.index') }}"
                    class="flex group items-center justify-center w-9 h-9 rounded-full hover:bg-white hover:shadow-sm transition-all duration-300 relative">
                    <img src="{{ asset('img/image 35.png') }}" alt="Cart"
                        class="w-5 h-5 object-contain opacity-60 group-hover:opacity-100 transition-opacity">
                    <span id="cart-count"
                        class="{{ (session('cart') && count(session('cart')) > 0) ? '' : 'hidden' }} absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
                        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                    </span>
                </a>
            </div>

            <!-- CTA & Actions (User Profile Only) -->
            <div class="flex items-center relative z-[110]">
                @auth
                <!-- Logged In User Dropdown -->
                <div class="hidden md:block relative ml-4">
                    <button id="user-menu-button" type="button"
                        class="flex items-center justify-center px-8 py-2.5 bg-white border border-gray-100 rounded-full shadow-sm hover:shadow-md transition-all duration-300 focus:outline-none">
                        <span class="text-sm font-bold text-gray-800 tracking-wide">{{ Auth::user()->name }}</span>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-menu-dropdown"
                        class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] border border-gray-100 py-2 origin-top-right transition-all duration-300 transform opacity-0 translate-y-2 pointer-events-none z-[120]">

                        <!-- Arrow pointing up -->
                        <div
                            class="absolute -top-2 right-6 w-4 h-4 bg-white border-t border-l border-gray-100 transform rotate-45">
                        </div>

                        <div class="px-5 py-4 border-b border-gray-50 relative z-10 flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-narita-gold/10 flex items-center justify-center text-xs font-bold text-narita-gold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">Akun pelanggan</p>
                            </div>
                        </div>

                        <div class="py-1 relative z-10">
                            @if(Auth::user()->is_admin ?? false)
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors font-medium">
                                    <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v9a1 1 0 001 1h3m10-10l2 2m-2-2v9a1 1 0 01-1 1h-3m-6 0h6" />
                                    </svg>
                                    <span>Admin Dashboard</span>
                                </a>
                                <div class="my-1 border-t border-gray-100"></div>
                            @endif
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors font-medium">
                                <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.118a7.5 7.5 0 0115 0A17.9 17.9 0 0112 21.75c-2.676 0-5.216-.584-7.5-1.632z" />
                                </svg>
                                <span>Profil Saya</span>
                            </a>
                            <a href="{{ route('orders.index') }}"
                                class="flex items-center px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors font-medium">
                                <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 5m12-5l2 5M10 21a1 1 0 11-2 0 1 1 0 012 0zm8 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                                <span>Lihat Pesanan</span>
                            </a>
                        </div>

                        <div class="border-t border-gray-50 py-1 relative z-10">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full text-left px-5 py-2.5 text-sm text-red-500 hover:bg-red-50 hover:text-red-600 transition-colors font-semibold">
                                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                            d="M17 16l4-4m0 0l-4-4m4 4H9m4 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <!-- Sign In Button -->
                <a href="{{ route('signin') }}"
                    class="hidden md:ml-4 md:inline-flex items-center justify-center px-6 py-2.5 border border-narita-gold text-narita-gold rounded-full text-xs lg:text-sm font-bold tracking-widest hover:bg-narita-gold hover:text-white transition duration-300 uppercase shadow-sm hover:shadow-md">
                    Sign In
                </a>
                @endauth

                <!-- Mobile Cart Button -->
                <a href="{{ route('cart.index') }}"
                    class="md:hidden ml-2 inline-flex items-center justify-center w-9 h-9 rounded-full hover:bg-gray-100 transition-colors relative">
                    <img src="{{ asset('img/image 35.png') }}" alt="Cart"
                        class="w-5 h-5 object-contain opacity-70">
                    <span id="cart-count-mobile"
                        class="{{ (session('cart') && count(session('cart')) > 0) ? '' : 'hidden' }} absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center">
                        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                    </span>
                </a>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" type="button"
                    class="md:hidden ml-4 inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:text-narita-gold hover:bg-gray-100 transition-colors focus:outline-none relative"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>

                    <!-- Icon menu (Hamburger) -->
                    <div class="relative w-6 h-6">
                        <svg id="icon-hamburger"
                            class="absolute inset-0 w-6 h-6 transition-all duration-300 ease-in-out transform rotate-0 opacity-100"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <!-- Icon menu (Close/X) -->
                        <svg id="icon-close"
                            class="absolute inset-0 w-6 h-6 transition-all duration-300 ease-in-out transform -rotate-90 opacity-0"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay & Panel -->
    <div class="md:hidden">
        <!-- Dark Overlay (Background Backdrop) -->
        <div id="mobile-menu-overlay"
            class="fixed inset-0 top-0 bg-black/60 backdrop-blur-sm z-[90] transition-opacity duration-300 opacity-0 pointer-events-none"
            onclick="toggleMobileMenu()"></div>

        <!-- Menu Content (Cream Glassmorphism) -->
        <div id="mobile-menu-panel"
            class="fixed top-[96px] left-0 w-full bg-[#FAFAFA]/95 backdrop-blur-xl border-b border-gray-100 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] z-[100] transition-all duration-300 ease-out transform -translate-y-10 opacity-0 pointer-events-none">

            <div class="px-6 py-8 space-y-3">
                <a href="{{ url('/') }}"
                    class="block text-center px-4 py-3 rounded-xl text-lg font-sans font-medium {{ request()->is('/') ? 'text-narita-gold bg-[#F3E5DC]/50 border border-[#F3E5DC]' : 'text-gray-600 hover:text-narita-gold hover:bg-[#F3E5DC]/30' }} transition-colors">Beranda</a>
                <a href="{{ url('/gallery') }}"
                    class="block text-center px-4 py-3 rounded-xl text-lg font-sans font-medium {{ request()->is('gallery') ? 'text-narita-gold bg-[#F3E5DC]/50 border border-[#F3E5DC]' : 'text-gray-600 hover:text-narita-gold hover:bg-[#F3E5DC]/30' }} transition-colors">Gallery</a>
                <a href="{{ route('catalog.index') }}"
                    class="block text-center px-4 py-3 rounded-xl text-lg font-sans font-medium {{ request()->routeIs('catalog.index') ? 'text-narita-gold bg-[#F3E5DC]/50 border border-[#F3E5DC]' : 'text-gray-600 hover:text-narita-gold hover:bg-[#F3E5DC]/30' }} transition-colors tracking-wider uppercase">Katalog</a>
                <a href="{{ url('/tentang') }}"
                    class="block text-center px-4 py-3 rounded-xl text-lg font-sans font-medium {{ request()->is('tentang') ? 'text-narita-gold bg-[#F3E5DC]/50 border border-[#F3E5DC]' : 'text-gray-600 hover:text-narita-gold hover:bg-[#F3E5DC]/30' }} transition-colors">Tentang</a>
                <a href="{{ url('/contact') }}"
                    class="block text-center px-4 py-3 rounded-xl text-lg font-sans font-medium {{ request()->is('contact') ? 'text-narita-gold bg-[#F3E5DC]/50 border border-[#F3E5DC]' : 'text-gray-600 hover:text-narita-gold hover:bg-[#F3E5DC]/30' }} transition-colors">Kontak</a>

                <div class="pt-6 border-t border-gray-100 mt-4">
                    @auth
                    <div class="flex items-center justify-center gap-4 mb-4">
                        <div
                            class="h-10 w-10 bg-narita-gold/10 rounded-full flex items-center justify-center text-narita-gold font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-lg font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    </div>
                    @if(Auth::user()->is_admin ?? false)
                    <a href="{{ route('admin.dashboard') }}"
                        class="block w-full text-center px-6 py-3 rounded-xl text-gray-700 hover:text-narita-gold hover:bg-[#F3E5DC]/40 font-semibold mb-2 transition-colors border border-gray-200">
                        Admin Dashboard
                    </a>
                    @endif
                    <a href="{{ route('profile.edit') }}"
                        class="block w-full text-center px-6 py-3 rounded-xl text-gray-600 hover:text-narita-gold hover:bg-[#F3E5DC]/30 font-medium mb-2 transition-colors">
                        Profil Saya
                    </a>
                    <a href="{{ route('orders.index') }}"
                        class="block w-full text-center px-6 py-3 rounded-xl text-gray-600 hover:text-narita-gold hover:bg-[#F3E5DC]/30 font-medium mb-2 transition-colors">
                        Lihat Pesanan
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-center px-6 py-4 border border-gray-200 text-gray-500 rounded-xl font-bold uppercase tracking-widest shadow-sm hover:bg-gray-50 transition transform active:scale-95">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('signin') }}"
                        class="block w-full text-center px-6 py-4 bg-narita-gold rounded-xl font-bold uppercase tracking-widest shadow-lg hover:shadow-xl hover:bg-[#c29d2b] transition transform active:scale-95">
                        Sign In
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Desktop User Dropdown Logic
        const userBtn = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-menu-dropdown');

        if (userBtn && userDropdown) {
            let isOpen = false;

            function toggleDropdown(open) {
                isOpen = open;
                userBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                if (isOpen) {
                    userDropdown.classList.remove('opacity-0', 'translate-y-2', 'pointer-events-none');
                    userDropdown.classList.add('opacity-100', 'translate-y-0', 'pointer-events-auto');
                } else {
                    userDropdown.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
                    userDropdown.classList.remove('opacity-100', 'translate-y-0', 'pointer-events-auto');
                }
            }

            userBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleDropdown(!isOpen);
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (isOpen && !userBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    toggleDropdown(false);
                }
            });

            // Close dropdown with Escape key
            document.addEventListener('keydown', (e) => {
                if (isOpen && e.key === 'Escape') {
                    toggleDropdown(false);
                }
            });
        }
    });

    // Mobile Menu Logic
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobilePanel = document.getElementById('mobile-menu-panel');
    const mobileOverlay = document.getElementById('mobile-menu-overlay');
    const iconHamburger = document.getElementById('icon-hamburger');
    const iconClose = document.getElementById('icon-close');
    let isMobileMenuOpen = false;

    function toggleMobileMenu() {
        isMobileMenuOpen = !isMobileMenuOpen;

        if (isMobileMenuOpen) {
            mobilePanel.classList.remove('opacity-0', 'pointer-events-none', '-translate-y-10');
            mobileOverlay.classList.remove('opacity-0', 'pointer-events-none');
            iconHamburger.classList.remove('opacity-100', 'rotate-0');
            iconHamburger.classList.add('opacity-0', 'rotate-90');
            iconClose.classList.remove('opacity-0', '-rotate-90');
            iconClose.classList.add('opacity-100', 'rotate-0');
        } else {
            mobilePanel.classList.add('opacity-0', 'pointer-events-none', '-translate-y-10');
            mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
            iconHamburger.classList.remove('opacity-0', 'rotate-90');
            iconHamburger.classList.add('opacity-100', 'rotate-0');
            iconClose.classList.remove('opacity-100', 'rotate-0');
            iconClose.classList.add('opacity-0', '-rotate-90');
        }
    }

    if (mobileBtn) {
        mobileBtn.addEventListener('click', toggleMobileMenu);
    }

    // Global Cart Sync Listener
    window.addEventListener('cart-updated', (e) => {
        const ids = ['cart-count', 'cart-count-mobile'];
        const count = e.detail.count;

        ids.forEach((id) => {
            const badge = document.getElementById(id);
            if (!badge) return;
            badge.innerText = count;
            if (count > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        });
    });
</script>