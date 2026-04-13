@extends('layout.app')

@section('title', 'Riwayat Evaluasi')

@section('content')

<section class="max-w-7xl mx-auto px-6 py-12 min-h-screen">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Evaluasi Rambut Anda</h1>
        <p class="text-gray-600">Daftar riwayat konsultasi kondisi rambut beserta hasil rekomendasinya.</p>
    </div>

    @if($assessments->isEmpty())
        <div class="bg-pink-50 p-8 rounded-2xl text-center border border-pink-100 flex flex-col items-center justify-center">
            <i class="fa-solid fa-clipboard-list text-6xl text-pink-300 mb-4"></i>
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Riwayat</h2>
            <p class="text-gray-500 mb-6">Anda belum pernah melakukan tes evaluasi kondisi rambut.</p>
            <a href="{{ route('permasalahan') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-medium py-3 px-8 rounded-full shadow-lg transition transform hover:scale-105">
                Mulai Tes Sekarang
            </a>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($assessments as $index => $assessment)
                <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100 hover:shadow-xl transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-pink-100 rounded-bl-full flex items-start justify-end p-3">
                        <span class="font-bold text-pink-500">#{{ $index + 1 }}</span>
                    </div>

                    <p class="text-sm text-gray-400 font-medium mb-4 flex items-center gap-2">
                        <i class="fa-regular fa-calendar text-pink-400"></i>
                        {{ $assessment->created_at->format('d M Y - H:i') }}
                    </p>

                    <div class="mb-4">
                        <strong class="text-gray-700 block mb-1 text-sm border-b pb-1">Masalah Rambut:</strong>
                        <div class="flex flex-wrap gap-1 mt-2">
                            @forelse($assessment->hairProblems as $problem)
                                <span class="bg-pink-100 text-pink-600 text-xs px-2 py-1 rounded-full font-medium">
                                    {{ $problem->name }}
                                </span>
                            @empty
                                <span class="text-gray-400 text-sm italic">Tidak ada</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="mb-6">
                        <strong class="text-gray-700 block mb-1 text-sm border-b pb-1">Kondisi Kulit Kepala:</strong>
                        <div class="flex flex-wrap gap-1 mt-2">
                            @forelse($assessment->scalpConditions as $scalp)
                                <span class="bg-blue-50 text-blue-500 border border-blue-200 text-xs px-2 py-1 rounded-full font-medium">
                                    {{ $scalp->name }}
                                </span>
                            @empty
                                <span class="text-gray-400 text-sm italic">Tidak ada</span>
                            @endforelse
                        </div>
                    </div>

                    <a href="{{ route('recommendation.show', $assessment->id) }}" class="block w-full text-center bg-gray-50 hover:bg-pink-500 text-pink-600 hover:text-white border border-pink-200 font-semibold py-2 rounded-xl transition-colors">
                        <i class="fa-solid fa-eye mr-2"></i> Lihat Hasil Evaluasi
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</section>

@endsection
