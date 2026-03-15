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
<section class="max-w-7xl mx-auto px-6 mb-8 mt-6 bg-gradient-to-r from-pink-50 to-white rounded-2xl p-6 shadow-lg">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center gap-2 text-gray-800 font-bold text-lg mb-4">
            <i class="fa fa-filter text-pink-500"></i> 
            <select class="bg-pink-500/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm font-medium text-white border border-pink-300/30" id="categories">
                <option value=""></option> 
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            
            <span>Filter Produk</span>
            </select>
        </div>

        <div class="border-t pt-4">
            <div class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
                <i class="fa fa-sort text-pink-500"></i> Urutkan Berdasarkan
            </div>

            <div class="flex gap-3 flex-wrap">
                <button id="priceAsc" class="chip" value="asc">💰 Harga: Rendah ke Tinggi</button>
                <button id="priceDesc" class="chip" value = "desc">💎 Harga: Tinggi ke Rendah</button>
        
            </div>
        </div>
    </div>
</section>

{{-- PRODUCT GRID --}}
<section class="max-w-7xl mx-auto px-6 pb-16">
    <div class="card shadow-lg rounded-2xl p-6 bg-white">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Produk Rekomendasi</h2>
            <button id="showAllProducts" type="button" class="text-pink-500 hover:text-pink-600 font-medium transition-colors" value="all">
                Lihat Semua <i class="fa-solid fa-arrow-right"></i>
            </button>
    </div>

    <div id="product-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
       @foreach($products as $product)
       <div  class="card card-shadow rounded-xl p-4 bg-pink-50 hover:shadow-lg transition-shadow">
        <div class="product-card animate-item group">
            <div class="relative overflow-hidden rounded-xl mb-3">
                <img src="{{$product->image_url}}" alt="{{$product->name}}"
                     class="w-full h-min object-cover group-hover:scale-110 transition-transform duration-500">
               
                <div class="absolute top-2 left-2 bg-white/90 backdrop-blur-sm p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                    <i class="fa-solid fa-heart text-pink-500"></i>
                </div>
            </div>

            <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-gray-800 flex-1">{{$product->name}}</h3>
               
            </div>
            <p class="text-sm text-gray-500 mb-1">{{$product->category->name}}</p>
            
            <a class="text-pink-500 text-sm mb-2" href="{{$product->source}}" class="text-xl text-gray-500 mb-4 block font-bold">Lihat Detail Produk</a>
            
            <div class="flex items-center justify-between">
                <div>
                    
                    <p class="text-lg font-bold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <button
                    onclick="addToCart('{{ $product->product_id }}', this)"
                    class="bg-pink-500 hover:bg-pink-600 text-white p-2 rounded-lg transition-colors">
                    <i class="fa-solid fa-cart-plus"></i>
                </button>
            </div>
        </div>
       </div>
        @endforeach
    </div>
    </div>
</section>

@endsection
