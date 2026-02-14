@extends('layout.app')

@section('title','Dashboard')

@section('content')

{{-- HERO SECTION --}}
<section class="w-full relative">
    <div class="relative w-full h-[450px]">
        <video autoplay loop muted playsinline class="w-full h-full object-cover">
            <source src="{{ asset('assets/images/vid.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/40 to-transparent"></div>

        <!-- Hero Content -->
        <div class="absolute left-10 md:left-20 top-1/2 -translate-y-1/2 text-white max-w-xl">
            <div class="inline-block bg-pink-500/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4 border border-pink-300/30">
                <span class="text-sm font-medium">✨ Rekomendasi Personal untuk Anda</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.6)]">
                Temukan Produk<br>
                <span class="text-pink-300">Perawatan Rambut</span><br>
                Terbaik untuk Anda
            </h1>
            
            <p class="text-lg mb-6 text-gray-200 drop-shadow-lg">
                Dapatkan rekomendasi produk yang sesuai dengan jenis dan kondisi rambut Anda
            </p>

            <div class="flex items-center bg-white/95 backdrop-blur-md rounded-full px-5 py-3 w-full max-w-md shadow-[0_10px_40px_rgba(0,0,0,0.4)] hover:shadow-[0_15px_50px_rgba(236,72,153,0.5)] transition-all duration-300 hover:scale-[1.02]">
                <i class="fa-solid fa-magnifying-glass text-pink-500 mr-3 text-lg"></i>
                <input type="text" placeholder="Cari produk perawatan rambut..."
                       class="outline-none w-full text-gray-700 bg-transparent placeholder:text-gray-400">
            </div>
        </div>
    </div>
</section>



{{-- FILTER SECTION --}}
<section class="max-w-7xl mx-auto px-6 mb-8 mt-6">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center gap-2 text-gray-800 font-bold text-lg mb-4">
            <i class="fa fa-filter text-pink-500"></i> 
            <span>Filter Produk</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <button class="chip-enhanced active">
                <i class="fa-solid fa-pump-soap"></i>
                <span>Shampoo</span>
            </button>
            <button class="chip-enhanced">
                <i class="fa-solid fa-droplet"></i>
                <span>Conditioner</span>
            </button>
            <button class="chip-enhanced">
                <i class="fa-solid fa-spa"></i>
                <span>Hair Mask</span>
            </button>
            <button class="chip-enhanced">
                <i class="fa-solid fa-flask"></i>
                <span>Hair Oil</span>
            </button>
        </div>

        <div class="border-t pt-4">
            <div class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                <i class="fa fa-sort text-pink-500"></i> Urutkan Berdasarkan
            </div>

            <div class="flex gap-3 flex-wrap">
                <button class="chip">💰 Harga: Rendah ke Tinggi</button>
                <button class="chip">💎 Harga: Tinggi ke Rendah</button>
                <button class="chip">⭐ Rating Tertinggi</button>
                <button class="chip">🔥 Terpopuler</button>
            </div>
        </div>
    </div>
</section>

{{-- PRODUCT GRID --}}
<section class="max-w-7xl mx-auto px-6 pb-16">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Produk Rekomendasi</h2>
        <a href="#" class="text-pink-500 hover:text-pink-600 font-medium flex items-center gap-2">
            Lihat Semua <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @for($i=0;$i<8;$i++)
        <div class="product-card group">
            <div class="relative overflow-hidden rounded-xl mb-3">
                <img src="{{ asset('assets/images/products1.jpg') }}"
                     class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-2 right-2 bg-pink-500 text-white text-xs px-2 py-1 rounded-full font-semibold">
                    -20%
                </div>
                <div class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                    <i class="fa-solid fa-heart text-pink-500"></i>
                </div>
            </div>

            <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-gray-800 flex-1">Nourishing Shampoo</h3>
                <div class="flex items-center gap-1 text-yellow-500 text-sm">
                    <i class="fa-solid fa-star"></i>
                    <span class="text-gray-600 font-medium">4.8</span>
                </div>
            </div>
            
            <p class="text-pink-500 text-sm mb-2">Untuk rambut kering dan rusak</p>
            
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-gray-400 line-through text-sm">Rp 150.000</span>
                    <p class="text-lg font-bold text-gray-800">Rp 120.000</p>
                </div>
                <button class="bg-pink-500 hover:bg-pink-600 text-white p-2 rounded-lg transition-colors">
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </div>
        </div>
        @endfor
    </div>
</section>

@endsection
