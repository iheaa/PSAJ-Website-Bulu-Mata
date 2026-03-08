@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
<div class="bg-slate-50 py-16 px-4 lg:py-24">
    <div class="max-w-4xl mx-auto flex flex-col items-center">
        
        <!-- Header Image -->
        <div class="w-full">
            <img 
                src="{{ asset('img/atas.png') }}" 
                alt="Narita Lashes Deskripsi" 
                class="w-full rounded-xl shadow-md object-cover aspect-video lg:aspect-auto lg:h-[400px]"
            />
        </div>

        <br>
        <br>
        
        
        <!-- Content Structure below image -->
        <div class="w-full pt-12 space-y-12">
            
            <!-- Apa itu Eyelash Section -->
            <div class="text-left w-full">
                <h1 class="font-sans text-3xl md:text-4xl font-bold text-gray-800 mb-5">Apa itu Eyelash ?</h1>
                <p class="font-sans text-[17px] md:text-lg text-gray-600 leading-relaxed">
                    Eyelash adalah teknik pasang bulu mata dengan menempelkan bulu mata palsu pada bulu mata asli
                    menggunakan perekat khusus. Hasilnya, bulu mata tampak lebih panjang, lebat, dan lentik alami tanpa
                    perlu repot merias mata setiap hari. Wink! ;)
                </p>
            </div>

            <!-- Mengapa memilih Narita Lashes Section -->
            <div class="text-left w-full">
                <h2 class="font-sans text-3xl md:text-4xl font-bold text-gray-800 mb-5">Mengapa memilih Narita Lashes ?</h2>
                <p class="font-sans text-[17px] md:text-lg text-gray-600 leading-relaxed">
                    Narita Lashes mengutamakan kualitas dalam setiap layanan. Setiap proses dilakukan dengan rapi,
                    higienis, dan penuh ketelitian agar pelanggan merasa nyaman. Hasil eyelash extension
                    disesuaikan dengan bentuk mata sehingga terlihat natural dan meningkatkan kepercayaan diri.
                </p>
            </div>

        </div>
    </div>
</div>

<!-- Pilihan Style Section -->
<div class="bg-white py-16 px-4 lg:py-24">
    <!-- Using flex-col-reverse for mobile stack order, md:flex-row to stay side-by-side on desktop -->
    <div class="max-w-4xl mx-auto flex flex-col-reverse md:flex-row gap-8 md:gap-12 items-start">
        
        <!-- Left Column (Text List) -->
        <div class="w-full md:w-[55%] space-y-6">
            <h2 class="font-serif font-bold text-3xl md:text-4xl text-gray-800 mb-8 leading-tight">
                Pilihan Style Eyelash<br>di Narita Lashes
            </h2>
            
            <div class="space-y-6">
                <!-- Catalog Items -->
                <div>
                    <h3 class="font-sans font-bold text-gray-900 text-lg">Classic Lashes</h3>
                    <p class="font-sans text-gray-500 text-[15px] mt-1 leading-relaxed">Tampilan rapi dan natural dengan hasil ringan, cocok untuk sehari-hari.</p>
                </div>
                <div>
                    <h3 class="font-sans font-bold text-gray-900 text-lg">Volume Lashes</h3>
                    <p class="font-sans text-gray-500 text-[15px] mt-1 leading-relaxed">Bulu mata terlihat lebih tebal dan penuh, memberi kesan lebih bold.</p>
                </div>
                <div>
                    <h3 class="font-sans font-bold text-gray-900 text-lg">Natural Lashes</h3>
                    <p class="font-sans text-gray-500 text-[15px] mt-1 leading-relaxed">Tampilan sederhana dan alami, seperti bulu mata asli yang lebih lentik.</p>
                </div>
                <div>
                    <h3 class="font-sans font-bold text-gray-900 text-lg">Soft Wispy Lashes</h3>
                    <p class="font-sans text-gray-500 text-[15px] mt-1 leading-relaxed">Bulu mata bervariasi panjangnya, memberi efek lembut dan manis.</p>
                </div>
                <div>
                    <h3 class="font-sans font-bold text-gray-900 text-lg">Doll Eye Lashes</h3>
                    <p class="font-sans text-gray-500 text-[15px] mt-1 leading-relaxed">Fokus di bagian tengah mata, membuat mata terlihat lebih besar dan bulat.</p>
                </div>
                <div class="pt-2">
                    <h3 class="font-sans font-bold text-gray-900 text-lg">Dan Lain-Lain</h3>
                </div>
            </div>
        </div>

        <!-- Right Column (Overlapping Raw Image) -->
        <div class="w-full md:w-[45%] max-w-xl mx-auto md:mx-0 mb-8 md:mb-0 relative md:mt-2 pb-12 pr-4 md:pr-8 flex justify-center md:justify-end">
            <div class="relative w-full">
                <!-- Back Image (Raw Floating) -->
                <img 
                    src="{{ asset('img/bawah.png') }}" 
                    alt="Pilihan Style Background" 
                    class="w-[85%] rounded-xl shadow-md object-cover ml-auto"
                />
            </div>
        </div>

    </div>
</div>
@endsection
