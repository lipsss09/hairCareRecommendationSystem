{{-- resources/views/recommendations/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Rekomendasi Produk Haircare')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">

    {{-- Header assessment --}}
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-800 mb-2">Rekomendasi untuk kamu</h1>

        <div class="flex flex-wrap gap-2 mt-3">
            @foreach($assessment->hairProblems as $problem)
                <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">
                    {{ $problem->name }}
                </span>
            @endforeach
            @foreach($assessment->scalpConditions as $scalp)
                <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm">
                    Kulit kepala {{ $scalp->name }}
                </span>
            @endforeach
            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm capitalize">
                Budget: {{ $assessment->budget }}
            </span>
        </div>
    </div>

    {{-- Hasil rekomendasi --}}
    @if($recommendations->isEmpty())
        <div class="text-center py-16 text-gray-500">
            <p class="text-lg">Tidak ada produk yang cocok ditemukan.</p>
            <p class="text-sm mt-2">Coba ubah pilihan masalah atau budget kamu.</p>
        </div>
    @else
        <p class="text-sm text-gray-500 mb-6">
            Menampilkan {{ $recommendations->count() }} produk paling relevan
        </p>

        <div class="space-y-4">
            @foreach($recommendations as $rank => $product)
            <div class="bg-white border border-gray-200 rounded-xl p-5 flex gap-5 hover:shadow-md transition-shadow">

                {{-- Rank badge --}}
                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-600 text-white flex items-center justify-center text-sm font-semibold">
                    {{ $rank + 1 }}
                </div>

                {{-- Gambar produk --}}
                <div class="flex-shrink-0">
                    @if($product->image_url)
                        <img src="{{ asset($product->image_url) }}"
                             alt="{{ $product->name }}"
                             class="w-20 h-20 object-cover rounded-lg bg-gray-100">
                    @else
                        <div class="w-20 h-20 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 text-xs text-center">
                            No image
                        </div>
                    @endif
                </div>

                {{-- Info produk --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wide">{{ $product->brand }}</p>
                            <h3 class="font-medium text-gray-800 capitalize leading-snug">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $product->category->name ?? '-' }}</p>
                        </div>

                        {{-- Skor similarity --}}
                        <div class="flex-shrink-0 text-right">
                            <div class="text-2xl font-bold text-purple-600">
                                {{ number_format($product->similarity_score * 100, 1) }}%
                            </div>
                            <div class="text-xs text-gray-400">kecocokan</div>
                        </div>
                    </div>

                    {{-- Progress bar similarity --}}
                    <div class="mt-3 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-purple-500 rounded-full transition-all"
                             style="width: {{ $product->similarity_score * 100 }}%">
                        </div>
                    </div>

                    {{-- Harga --}}
                    <p class="mt-2 text-sm font-semibold text-gray-700">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                        <span class="font-normal text-gray-400">/ {{ $product->size }} {{ $product->size_unit }}</span>
                    </p>

                    {{-- Bahan yang cocok (explanation) --}}
                    @if(!empty($product->matched_ingredients))
                        <div class="mt-3">
                            <p class="text-xs text-gray-500 mb-1.5">Bahan aktif yang cocok:</p>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($product->matched_ingredients as $match)
                                    <span class="px-2 py-0.5 rounded-full text-xs
                                        @if($match['priority'] == 3) bg-green-100 text-green-800
                                        @elseif($match['priority'] == 2) bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-600 @endif">
                                        {{ ucwords($match['ingredient']) }}
                                        @if($match['priority'] == 3)★★★
                                        @elseif($match['priority'] == 2)★★
                                        @else ★
                                        @endif
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
