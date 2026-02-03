@extends('layout.app')

@section('title','Dashboard')

@section('content')

<section class="w-full">
    <div class="relative w-full h-[350px]">
        <img src="{{ asset('assets/images/banner.jpg') }}"
             class="w-full h-full object-cover">

        <!-- Overlay biar teks jelas -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- TEXT -->
        <div class="absolute left-10 top-1/2 -translate-y-1/2 text-white">
            <h1 class="text-3xl font-bold mb-3">
                Temukan Produk Perawatan<br>Rambut Terbaik untuk Anda
            </h1>

            <div class="flex items-center bg-white rounded-full px-4 py-2 w-[300px]">
                <i class="fa-solid fa-magnifying-glass text-pink-500 mr-2"></i>
                <input type="text" placeholder="Cari Produk"
                       class="outline-none w-full text-gray-700">
            </div>
        </div>
    </div>
</section>

{{-- FILTER SECTION --}}
<section class="max-w-7xl mx-auto px-6 mt-8">

    <div class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
        <i class="fa fa-filter"></i> Filters
    </div>

    <div class="flex gap-3 flex-wrap mb-6">
        <button class="chip">Shampoo</button>
        <button class="chip">Conditioner</button>
        <button class="chip">Hair Mask</button>
        <button class="chip">Hair Oil</button>
    </div>

    <div class="flex items-center gap-2 text-gray-700 font-semibold mb-3">
        <i class="fa fa-sort"></i> Urutkan Berdasarkan
    </div>

    <div class="flex gap-3 flex-wrap mb-8">
        <button class="chip">Harga: Rendah ke Tinggi</button>
        <button class="chip">Harga: Tinggi ke Rendah</button>
        <button class="chip">Rating</button>
    </div>

</section>

{{-- PRODUCT GRID --}}
<section class="max-w-7xl mx-auto px-6 pb-16 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">

    @for($i=0;$i<8;$i++)
    <div class="product-card">
        <img src="{{ asset('assets/images/products1.jpg') }}"
             class="rounded-xl w-full h-40 object-cover mb-3">

        <h3 class="font-semibold text-gray-800">Nourishing Shampoo</h3>
        <p class="text-pink-500 text-sm">Untuk rambut kering dan rusak</p>
    </div>
    @endfor

</section>

@endsection
