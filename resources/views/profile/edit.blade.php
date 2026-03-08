@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="bg-gray-50/50 min-h-screen pb-24 pt-8 md:pt-12 font-sans text-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm font-medium text-green-800" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800" role="alert">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Desktop layout (mirip referensi): sidebar kiri + konten kanan --}}
        <div class="flex flex-col md:flex-row gap-6 md:gap-10 items-start">
            {{-- Sidebar (desktop) --}}
            <aside class="hidden md:block md:w-72 lg:w-80 flex-shrink-0">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                    {{-- User summary --}}
                    <div class="px-5 py-5 border-b border-gray-100 flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center font-bold text-gray-700">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <div class="text-sm font-bold text-gray-900 truncate">{{ $user->name }}</div>
                        </div>
                    </div>

                    {{-- Menu --}}
                    <div class="py-2">
                        <button type="button" data-tab="akun" class="profile-tab profile-tab--desktop active flex items-center gap-3 w-full px-5 py-3 text-left text-sm font-semibold transition-colors bg-gray-50/80">
                            <span class="profile-tab-icon flex-shrink-0 w-6 h-6 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>
                            </span>
                            <span class="profile-tab-label text-red-600">Akun Saya</span>
                        </button>

                        <button type="button" data-tab="pesanan" class="profile-tab profile-tab--desktop flex items-center gap-3 w-full px-5 py-3 text-left text-sm font-semibold transition-colors hover:bg-gray-50/80">
                            <span class="profile-tab-icon flex-shrink-0 w-6 h-6 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75M9 6h6.75M6 3.75h12A2.25 2.25 0 0120.25 6v14.25A2.25 2.25 0 0118 22.5H6A2.25 2.25 0 013.75 20.25V6A2.25 2.25 0 016 3.75z" /></svg>
                            </span>
                            <span class="profile-tab-label text-gray-600">Pesanan Saya</span>
                        </button>
                    </div>
                </div>

            </aside>
            {{-- Main content --}}
            <div class="flex-1 min-w-0 w-full md:pl-6 lg:pl-8 ml-2">
                {{-- Header (mirip referensi) --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm px-6 py-5">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900 mt-2">Profil Saya</h1>
                    <p class="text-sm text-gray-500 mt-1 mb-4">Kelola informasi profil Anda untuk mengontrol, melindungi, dan mengamankan akun</p>
                    <div class="mt-5 border-t border-gray-100"></div>

                    {{-- Mobile tabs --}}
                    <div class="md:hidden mt-5 flex gap-2 overflow-x-auto pb-1">
                        <button type="button" data-tab="akun" class="profile-tab profile-tab--mobile active whitespace-nowrap px-5 py-3 rounded-xl text-left text-sm font-semibold transition-all bg-white border border-gray-200 text-narita-gold shadow-sm">Akun Saya</button>
                        <button type="button" data-tab="pesanan" class="profile-tab profile-tab--mobile whitespace-nowrap px-5 py-3 rounded-xl text-left text-sm font-semibold transition-all border border-gray-200 text-gray-600 hover:bg-white hover:shadow-sm">Pesanan Saya</button>
                    </div>
                </div>

                {{-- Tab panels --}}
                <div class="mt-6 space-y-6">
                {{-- Section 1: Akun Saya (Account Settings) --}}
                <section id="panel-akun" class="profile-panel space-y-8">
                    {{-- Card: Update Profile --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-lg font-bold text-gray-900">Informasi Profil</h2>
                            <p class="text-sm text-gray-500 mt-0.5">Perbarui nama dan email Anda</p>
                        </div>
                        <form action="{{ route('profile.update') }}" method="POST" class="p-6 md:p-8" id="form-profile">
                            @csrf
                            @method('patch')
                            <div class="space-y-5">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2 ml-4">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-narita-gold focus:ring-narita-gold py-3 px-4 transition-all"
                                        placeholder="Nama lengkap Anda">
                                </div>
                                <br>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2 ml-4">Alamat Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-narita-gold focus:ring-narita-gold py-3 px-4 transition-all"
                                        placeholder="email@contoh.com">
                                </div>
                            </div>
                            <div class="mt-6">
                                <button 
                                type="submit" 
                                class="btn-save-profile inline-flex items-center justify-center px-6 py-3 rounded-full font-bold text-sm w-fit bg-gray-300"
                                data-loading-text="Menyimpan...">

                                    <span class="btn-text">Simpan Perubahan</span>

                                    <span class="btn-spinner hidden">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                        </svg>
                                    </span>

                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Card: Security / Change Password --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-lg font-bold text-gray-900">Keamanan</h2>
                            <p class="text-sm text-gray-500 mt-0.5">Ubah password akun Anda</p>
                        </div>
                        <form action="{{ route('profile.password.update') }}" method="POST" class="p-6 md:p-8" id="form-password">
                            @csrf
                            @method('put')
                            <div class="space-y-5">
                                <div>
                                    <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2 ml-4">Password Saat Ini <span class="text-red-500">*</span></label>
                                    <input type="password" name="current_password" id="current_password" required autocomplete="current-password"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-narita-gold focus:ring-narita-gold py-3 px-4 transition-all"
                                        placeholder="••••••••">
                                </div>
                                <br>
                                <div>
                                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2 ml-4">Password Baru <span class="text-red-500">*</span></label>
                                    <input type="password" name="password" id="password" required autocomplete="new-password" minlength="8"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-narita-gold focus:ring-narita-gold py-3 px-4 transition-all"
                                        placeholder="Min. 8 karakter">
                                </div>
                                <br>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2 ml-4">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-narita-gold focus:ring-narita-gold py-3 px-4 transition-all"
                                        placeholder="••••••••">
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="btn-save-password inline-flex items-center justify-center px-6 py-3 rounded-full font-bold text-sm w-fit bg-gray-300" data-loading-text="Menyimpan...">
                                    <span class="btn-text">Simpan Password</span>
                                    <span class="btn-spinner hidden">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </section>

                {{-- Section 2: Lihat Pesanan (Order History) --}}
                <section id="panel-pesanan" class="profile-panel hidden space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <h2 class="text-xl font-bold text-gray-900">Riwayat Pesanan</h2>
                    </div>

                    @if($orders->count() > 0)
                        <div class="space-y-4 md:space-y-5 lg:space-y-6 overflow-x-hidden">
                            @foreach($orders as $order)
                                @php
                                    $firstItem = $order->items->first();
                                    $statusClasses = [
                                        'pending' => 'bg-amber-100 text-amber-800 border-amber-200',
                                        'unpaid' => 'bg-red-100 text-red-800 border-red-200',
                                        'paid' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'shipped' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'completed' => 'bg-green-100 text-green-800 border-green-200',
                                        'cancelled' => 'bg-gray-100 text-gray-600 border-gray-200',
                                    ];
                                    $statusLabel = [
                                        'pending' => 'Pending',
                                        'unpaid' => 'Pending',
                                        'paid' => 'Diproses',
                                        'processing' => 'Diproses',
                                        'shipped' => 'Diproses',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                    ];
                                    $currentStatus = strtolower($order->status);
                                    $class = $statusClasses[$currentStatus] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                    $label = $statusLabel[$currentStatus] ?? ucfirst($order->status);
                                @endphp
                                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md md:hover:shadow-lg md:hover:-translate-y-0.5 transition-all">
                                    <div class="p-4 sm:p-5 md:p-6 flex flex-col md:flex-row md:items-center gap-4 md:gap-6">
                                        {{-- Product thumbnail (first item) --}}
                                        <div class="w-20 h-20 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-20 lg:h-20 rounded-2xl bg-gray-100 border border-gray-200 flex-shrink-0 overflow-hidden">
                                            @if($firstItem && $firstItem->product && $firstItem->product->image)
                                                <img src="{{ asset($firstItem->product->image) }}" alt="{{ $firstItem->product_name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- Details --}}
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm md:text-base font-semibold text-gray-900 line-clamp-2">
                                                @if($order->items->count() === 1)
                                                    {{ $firstItem ? $firstItem->product_name : 'Pesanan #' . $order->id }}
                                                @else
                                                    {{ $firstItem ? $firstItem->product_name : 'Pesanan' }} +{{ $order->items->count() - 1 }} barang lainnya
                                                @endif
                                            </p>
                                            <p class="text-xs md:text-sm text-gray-500 mt-1">
                                                {{ $order->items->sum('quantity') }} barang · Total Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </p>
                                            <div class="mt-2 flex flex-wrap items-center gap-2 text-xs md:text-[13px]">
                                                <p class="text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-medium border {{ $class }}">{{ $label }}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- Empty state --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">
                            <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-5">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                            <p class="text-gray-500 text-sm max-w-sm mx-auto mb-6">Anda belum memiliki riwayat pembelian. Mulai temukan produk bulu mata favorit Anda.</p>
                            <a href="{{ route('catalog.index') }}" class="inline-flex items-center justify-center px-8 py-3 rounded-xl font-bold text-sm text-white bg-narita-gold hover:bg-amber-600 shadow-md hover:shadow-lg transition-all">
                                Belanja Sekarang
                            </a>
                        </div>
                    @endif
                </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.profile-tab');
    const panels = document.querySelectorAll('.profile-panel');

    function setPanel(tabKey) {
        var targetId = 'panel-' + tabKey;

        // Panels
        panels.forEach(function (panel) {
            panel.classList.toggle('hidden', panel.id !== targetId);
        });

        // Tabs (sync desktop + mobile by data-tab)
        tabs.forEach(function (t) {
            var isDesktop = t.classList.contains('profile-tab--desktop');
            var isMobile = t.classList.contains('profile-tab--mobile');
            var isTarget = t.getAttribute('data-tab') === tabKey;
            var label = t.querySelector('.profile-tab-label');
            var icon = t.querySelector('.profile-tab-icon');

            if (isDesktop) {
                t.classList.toggle('bg-gray-50/80', isTarget);
                t.classList.toggle('active', isTarget);
                if (label) {
                    label.classList.toggle('text-red-600', isTarget);
                    label.classList.toggle('text-gray-600', !isTarget);
                }
                if (icon) {
                    icon.classList.toggle('text-red-600', isTarget);
                    icon.classList.toggle('text-gray-500', !isTarget);
                }
            } else if (isMobile) {
                t.classList.toggle('active', isTarget);
                t.classList.toggle('bg-white', isTarget);
                t.classList.toggle('shadow-sm', isTarget);
                t.classList.toggle('text-narita-gold', isTarget);
                t.classList.toggle('text-gray-600', !isTarget);
            }
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var key = this.getAttribute('data-tab');
            if (key) setPanel(key);
        });
    });

    // Initial state
    setPanel('akun');

    // Save buttons loading state
    document.getElementById('form-profile')?.addEventListener('submit', function () {
        var btn = this.querySelector('.btn-save-profile');
        if (btn && !btn.disabled) {
            btn.disabled = true;
            btn.querySelector('.btn-text').textContent = btn.getAttribute('data-loading-text') || 'Menyimpan...';
            btn.querySelector('.btn-spinner')?.classList.remove('hidden');
        }
    });
    document.getElementById('form-password')?.addEventListener('submit', function () {
        var btn = this.querySelector('.btn-save-password');
        if (btn && !btn.disabled) {
            btn.disabled = true;
            btn.querySelector('.btn-text').textContent = btn.getAttribute('data-loading-text') || 'Menyimpan...';
            btn.querySelector('.btn-spinner')?.classList.remove('hidden');
        }
    });
});
</script>
@endsection
