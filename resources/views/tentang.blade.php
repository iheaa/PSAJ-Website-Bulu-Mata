@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
<div class="bg-white">
    {{-- Hero --}}
    <section class="max-w-6xl mx-auto px-6 pt-10 pb-12 md:pt-16 md:pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center">
            <div>
                <h1 class="font-serif text-4xl md:text-5xl font-bold text-gray-900 tracking-tight leading-tight">
                    Tentang Narita Lashes
                </h1>
                <p class="mt-4 text-gray-600 leading-relaxed text-base md:text-lg max-w-prose">
                    Kami membantu Anda mendapatkan tampilan bulu mata yang rapi, lentik, dan elegan—dengan proses yang nyaman dan higienis.
                </p>
           
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-gradient-to-br from-narita-champagne/50 to-narita-nude/40 rounded-[2rem] blur-2xl"></div>
                <div class="relative rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('img/atas.png') }}" alt="Narita Lash Look" class="w-full h-[280px] sm:h-[360px] md:h-[440px] object-cover">
                </div>
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="max-w-6xl mx-auto px-6 pb-12 md:pb-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
            <div class="bg-gray-50/60 border border-gray-100 rounded-2xl p-7 md:p-8">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">Apa itu Eyelash?</h2>
                <br>
                <p class="mt-3 text-gray-600 leading-relaxed">
                    Eyelash adalah teknik pasang bulu mata dengan menempelkan bulu mata palsu pada bulu mata asli menggunakan perekat khusus.
                    Hasilnya, bulu mata tampak lebih panjang, lebat, dan lentik alami tanpa perlu repot merias mata setiap hari.
                </p>
            </div>
            <br>
            <div class="bg-gray-50/60 border border-gray-100 rounded-2xl p-7 md:p-8">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">Mengapa memilih Narita Lashes?</h2>
                <br>
                <p class="mt-3 text-gray-600 leading-relaxed">
                    Narita Lashes mengutamakan kualitas dalam setiap layanan. Setiap proses dilakukan dengan rapi, higienis, dan penuh ketelitian
                    agar pelanggan merasa nyaman. Hasil eyelash extension disesuaikan dengan bentuk mata sehingga terlihat natural dan meningkatkan kepercayaan diri.
                </p>
            </div>
        </div>
    </section>

    {{-- Styles --}}
    <section class="max-w-6xl mx-auto px-6 pb-20 md:pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-start">
            <div class="order-2 lg:order-1">
                <h2 class="font-serif text-3xl md:text-4xl font-bold text-gray-900 tracking-tight leading-tight">
                    Pilihan Style Eyelash
                </h2>
                <p class="mt-3 text-gray-600 leading-relaxed max-w-prose">
                    Beragam pilihan style untuk menyesuaikan karakter dan kebutuhan Anda—mulai dari natural sampai bold.
                </p>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-1">Classic Lashes</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Tampilan rapi dan natural, cocok untuk sehari-hari.</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-1">Volume Lashes</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Lebih tebal dan penuh untuk look yang bold.</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-1">Natural Lashes</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Sederhana dan lembut, seperti bulu mata asli.</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-1">Soft Wispy Lashes</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Variasi panjang untuk efek manis dan airy.</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-1">Doll Eye Lashes</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Fokus tengah mata agar tampak lebih besar.</p>
                    </div>
                    <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 mb-1">Dan Lain-Lain</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Bisa request sesuai kebutuhan dan preferensi Anda.</p>
                    </div>
                </div>
            </div>

            <div class="order-1 lg:order-2 relative">
                <div class="absolute -inset-4 bg-gradient-to-br from-narita-nude/50 to-narita-champagne/40 rounded-[2rem] blur-2xl"></div>
                <div class="relative rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                    <img src="{{ asset('img/bawah.png') }}" alt="Narita Lash Models" class="w-full h-[340px] sm:h-[420px] md:h-[520px] object-cover">
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
