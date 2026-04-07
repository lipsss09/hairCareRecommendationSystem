@extends('layout.app')

@section('title', 'Rekomendasi Produk')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Flash message --}}
    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-800">Rekomendasi produk untuk kamu</h1>
        <p class="text-sm text-gray-500 mt-1">Berdasarkan analisis kandungan bahan aktif yang cocok dengan kondisi rambutmu</p>

        {{-- Tag masalah & kondisi --}}
        <div class="flex flex-wrap gap-2 mt-4">
            @foreach($assessment->hairProblems as $problem)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                    {{ $problem->name }}
                </span>
            @endforeach
            @foreach($assessment->scalpConditions as $scalp)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                    Kulit kepala {{ $scalp->name }}
                </span>
            @endforeach
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 capitalize">
                Budget: {{ $assessment->budget }}
            </span>
        </div>
    </div>

    {{-- Hasil rekomendasi --}}
    @if($recommendations->isEmpty())
        <div class="text-center py-20">
            <div class="text-gray-300 text-6xl mb-4">🔍</div>
            <p class="text-gray-500 font-medium">Belum ada produk yang cocok ditemukan.</p>
            <p class="text-sm text-gray-400 mt-1">Coba ubah pilihan masalah atau rentang budget kamu.</p>
            <a href="{{ route('permasalahan') }}"
               class="inline-block mt-6 px-5 py-2 bg-purple-600 text-white text-sm rounded-lg hover:bg-purple-700 transition">
                Ubah Assessment
            </a>
        </div>
    @else
        <p class="text-sm text-gray-400 mb-5">
            Menampilkan <span class="font-medium text-gray-600">{{ $recommendations->count() }} produk</span> paling relevan
        </p>

        <div class="space-y-4">
            @foreach($recommendations as $rank => $product)
            <div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-4 hover:shadow-md hover:border-purple-200 transition-all">

                {{-- Rank --}}
                <div class="flex-shrink-0 w-7 h-7 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs font-bold">
                    {{ $rank + 1 }}
                </div>

                {{-- Gambar --}}
                <div class="flex-shrink-0">
                    @if($product->image_url)
                        <img src="{{ asset($product->image_url) }}"
                             alt="{{ $product->name }}"
                             class="w-20 h-20 object-cover rounded-lg bg-gray-50">
                    @else
                        <div class="w-20 h-20 rounded-lg bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-300 text-xs text-center leading-tight">No<br>Image</span>
                        </div>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="flex-1 min-w-0">

                    {{-- Nama & skor --}}
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-xs text-gray-400 uppercase tracking-wide truncate">{{ $product->brand }}</p>
                            <h3 class="font-medium text-gray-800 capitalize leading-snug">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $product->category->name ?? '-' }}</p>
                        </div>
                        <div class="flex-shrink-0 text-right">
                            <div class="text-xl font-bold text-purple-600">
                                {{ number_format($product->similarity_score * 100, 1) }}%
                            </div>
                            <div class="text-xs text-gray-400">kecocokan</div>
                        </div>
                    </div>

                    {{-- Progress bar --}}
                    <div class="mt-2 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all"
                             style="width: {{ $product->similarity_score * 100 }}%;
                                    background: linear-gradient(to right, #9333ea, #7c3aed)">
                        </div>
                    </div>

                    {{-- Harga --}}
                    <p class="mt-2 text-sm font-semibold text-gray-700">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                        <span class="font-normal text-gray-400 text-xs">
                            / {{ $product->size }}{{ $product->size_unit }}
                        </span>
                    </p>

                    {{-- Matched ingredients --}}
                    @if(!empty($product->matched_ingredients))
                        <div class="mt-3">
                            <p class="text-xs text-gray-400 mb-1.5">Bahan aktif yang cocok:</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($product->matched_ingredients as $match)
                                    @php
                                        $color = match($match['priority']) {
                                            3 => 'bg-green-50 text-green-700 border border-green-200',
                                            2 => 'bg-blue-50 text-blue-700 border border-blue-200',
                                            default => 'bg-gray-50 text-gray-500 border border-gray-200',
                                        };
                                        $stars = str_repeat('★', $match['priority']) . str_repeat('☆', 3 - $match['priority']);
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs {{ $color }}">
                                        {{ ucwords($match['ingredient']) }}
                                        <span class="opacity-60 text-xs">{{ $stars }}</span>
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            @endforeach
        </div>

        {{-- Tombol ulangi assessment --}}
        <div class="mt-8 text-center">
            <a href="{{ route('permasalahan') }}"
               class="inline-block px-6 py-2.5 border border-purple-600 text-purple-600 text-sm rounded-lg hover:bg-purple-50 transition">
                Ulangi Assessment
            </a>
        </div>

    @endif

</div>
@endsection
