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

        {{-- ================================================================== --}}
        {{-- EVALUASI REKOMENDASI - Precision@K, Recall@K, F1-Score             --}}
        {{-- ================================================================== --}}
        @if(isset($evaluation))
        <div class="mt-10 mb-6">
            <div class="bg-gradient-to-br from-slate-50 to-purple-50 border border-purple-200 rounded-2xl overflow-hidden shadow-sm">

                {{-- Header Evaluasi --}}
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-white">Evaluasi Sistem Rekomendasi</h2>
                            <p class="text-purple-200 text-xs">Mengukur kualitas hasil rekomendasi menggunakan metrik Information Retrieval</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">

                    {{-- Metric Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                        {{-- Precision@K --}}
                        @php
                            $precisionPct = $evaluation['precision_at_k'] * 100;
                            $precisionColor = $precisionPct >= 70 ? 'text-emerald-600' : ($precisionPct >= 40 ? 'text-amber-600' : 'text-red-500');
                            $precisionBg = $precisionPct >= 70 ? 'from-emerald-50 to-emerald-100/50 border-emerald-200' : ($precisionPct >= 40 ? 'from-amber-50 to-amber-100/50 border-amber-200' : 'from-red-50 to-red-100/50 border-red-200');
                            $precisionRing = $precisionPct >= 70 ? 'text-emerald-500' : ($precisionPct >= 40 ? 'text-amber-500' : 'text-red-400');
                        @endphp
                        <div class="bg-gradient-to-br {{ $precisionBg }} border rounded-xl p-5 relative overflow-hidden">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Precision@K</p>
                                    <p class="text-3xl font-bold {{ $precisionColor }} mt-1">{{ number_format($precisionPct, 1) }}%</p>
                                </div>
                                <div class="relative w-14 h-14">
                                    <svg class="w-14 h-14 transform -rotate-90" viewBox="0 0 56 56">
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" stroke-width="4" class="text-gray-200"/>
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" stroke-width="4"
                                                class="{{ $precisionRing }}"
                                                stroke-dasharray="{{ 2 * 3.14159 * 24 }}"
                                                stroke-dashoffset="{{ 2 * 3.14159 * 24 * (1 - $evaluation['precision_at_k']) }}"
                                                stroke-linecap="round"/>
                                    </svg>
                                    <span class="absolute inset-0 flex items-center justify-center text-xs font-bold {{ $precisionColor }}">
                                        {{ round($precisionPct) }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                <span class="font-semibold">{{ $evaluation['relevant_in_topk'] }}</span> dari
                                <span class="font-semibold">{{ $evaluation['k'] }}</span> produk di Top-K bernilai relevan
                            </p>
                            <div class="mt-2 text-xs text-gray-400 bg-white/60 rounded-md px-2 py-1 inline-block">
                                Formula: Relevant in Top-K / K
                            </div>
                        </div>

                        {{-- Recall@K --}}
                        @php
                            $recallPct = $evaluation['recall_at_k'] * 100;
                            $recallColor = $recallPct >= 70 ? 'text-emerald-600' : ($recallPct >= 40 ? 'text-amber-600' : 'text-red-500');
                            $recallBg = $recallPct >= 70 ? 'from-emerald-50 to-emerald-100/50 border-emerald-200' : ($recallPct >= 40 ? 'from-amber-50 to-amber-100/50 border-amber-200' : 'from-red-50 to-red-100/50 border-red-200');
                            $recallRing = $recallPct >= 70 ? 'text-emerald-500' : ($recallPct >= 40 ? 'text-amber-500' : 'text-red-400');
                        @endphp
                        <div class="bg-gradient-to-br {{ $recallBg }} border rounded-xl p-5 relative overflow-hidden">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Recall@K</p>
                                    <p class="text-3xl font-bold {{ $recallColor }} mt-1">{{ number_format($recallPct, 1) }}%</p>
                                </div>
                                <div class="relative w-14 h-14">
                                    <svg class="w-14 h-14 transform -rotate-90" viewBox="0 0 56 56">
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" stroke-width="4" class="text-gray-200"/>
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" stroke-width="4"
                                                class="{{ $recallRing }}"
                                                stroke-dasharray="{{ 2 * 3.14159 * 24 }}"
                                                stroke-dashoffset="{{ 2 * 3.14159 * 24 * (1 - $evaluation['recall_at_k']) }}"
                                                stroke-linecap="round"/>
                                    </svg>
                                    <span class="absolute inset-0 flex items-center justify-center text-xs font-bold {{ $recallColor }}">
                                        {{ round($recallPct) }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                <span class="font-semibold">{{ $evaluation['relevant_in_topk'] }}</span> dari
                                <span class="font-semibold">{{ $evaluation['total_relevant'] }}</span> total produk relevan berhasil muncul di Top-K
                            </p>
                            <div class="mt-2 text-xs text-gray-400 bg-white/60 rounded-md px-2 py-1 inline-block">
                                Formula: Relevant in Top-K / Total Relevant
                            </div>
                        </div>

                        {{-- F1-Score --}}
                        @php
                            $f1Pct = $evaluation['f1_score'] * 100;
                            $f1Color = $f1Pct >= 70 ? 'text-emerald-600' : ($f1Pct >= 40 ? 'text-amber-600' : 'text-red-500');
                            $f1Bg = $f1Pct >= 70 ? 'from-emerald-50 to-emerald-100/50 border-emerald-200' : ($f1Pct >= 40 ? 'from-amber-50 to-amber-100/50 border-amber-200' : 'from-red-50 to-red-100/50 border-red-200');
                            $f1Ring = $f1Pct >= 70 ? 'text-emerald-500' : ($f1Pct >= 40 ? 'text-amber-500' : 'text-red-400');
                        @endphp
                        <div class="bg-gradient-to-br {{ $f1Bg }} border rounded-xl p-5 relative overflow-hidden">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">F1-Score</p>
                                    <p class="text-3xl font-bold {{ $f1Color }} mt-1">{{ number_format($f1Pct, 1) }}%</p>
                                </div>
                                <div class="relative w-14 h-14">
                                    <svg class="w-14 h-14 transform -rotate-90" viewBox="0 0 56 56">
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" stroke-width="4" class="text-gray-200"/>
                                        <circle cx="28" cy="28" r="24" fill="none" stroke="currentColor" stroke-width="4"
                                                class="{{ $f1Ring }}"
                                                stroke-dasharray="{{ 2 * 3.14159 * 24 }}"
                                                stroke-dashoffset="{{ 2 * 3.14159 * 24 * (1 - $evaluation['f1_score']) }}"
                                                stroke-linecap="round"/>
                                    </svg>
                                    <span class="absolute inset-0 flex items-center justify-center text-xs font-bold {{ $f1Color }}">
                                        {{ round($f1Pct) }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 leading-relaxed">
                                Harmonic mean dari Precision dan Recall
                            </p>
                            <div class="mt-2 text-xs text-gray-400 bg-white/60 rounded-md px-2 py-1 inline-block">
                                Formula: 2 × (P × R) / (P + R)
                            </div>
                        </div>

                    </div>

                    {{-- Detail Informasi --}}
                    <div class="bg-white rounded-xl border border-gray-200 divide-y divide-gray-100">
                        <div class="px-5 py-3 flex items-center justify-between">
                            <span class="text-sm text-gray-600">Ground Truth Threshold</span>
                            <span class="text-sm font-semibold text-purple-600">{{ $evaluation['threshold'] }} (Similarity Score ≥ {{ $evaluation['threshold'] * 100 }}%)</span>
                        </div>
                        <div class="px-5 py-3 flex items-center justify-between">
                            <span class="text-sm text-gray-600">Jumlah K (Top-K)</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $evaluation['k'] }} produk</span>
                        </div>
                        <div class="px-5 py-3 flex items-center justify-between">
                            <span class="text-sm text-gray-600">Produk Relevan di Top-K</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $evaluation['relevant_in_topk'] }} produk</span>
                        </div>
                        <div class="px-5 py-3 flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Produk Relevan di Database</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $evaluation['total_relevant'] }} produk</span>
                        </div>
                        <div class="px-5 py-3 flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Produk Dievaluasi</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $evaluation['total_products'] }} produk</span>
                        </div>
                    </div>

                    {{-- Note --}}
                    <div class="mt-4 flex items-start gap-2 text-xs text-gray-400">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p>
                            Produk dianggap <strong class="text-gray-500">relevan</strong> jika memiliki similarity score ≥ {{ $evaluation['threshold'] * 100 }}%.
                            Evaluasi dihitung berdasarkan metode <strong class="text-gray-500">Precision@K</strong>, <strong class="text-gray-500">Recall@K</strong>, dan <strong class="text-gray-500">F1-Score</strong>
                            (Dwiyantoro, 2017).
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

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
