@extends('layout.app')

@section('title', 'hairProblem')

@section('content')
<div class="min-h-screen bg-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Apa Masalah Pada Rambut Anda</h1>
            <p class="text-pink-600 text-lg">Bagikan Kisah Tentang Rambut Anda Pada Kami</p>
        </div>

        {{-- Tampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('hair.assessment.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Hair Type Section -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Bagaimana Tipe Rambut Anda ?</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-1">
                    <!-- Bergelombang -->
                    <label class="cursor-pointer w-64 h-64">
                        <input type="radio" name="hair_type" value="bergelombang" class="peer hidden"
                            {{ old('hair_type') == 'bergelombang' ? 'checked' : '' }} >
                        <div class="border-2 border-gray-300 w-64 h-64 rounded-lg p-6 text-center transition-all hover:border-pink-400 peer-checked:border-pink-500 peer-checked:bg-pink-50">
                            <div class="aspect-square bg-pink-100 rounded-lg  f`lex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets/images/bergelombang.png') }}" alt="Bergelombang" class="w-full h-full object-cover">
                            </div>
                            <p class="font-medium text-gray-900">Bergelombang</p>
                        </div>
                    </label>

                    <!-- Lurus -->
                    <label class="cursor-pointer w-64 h-64">
                        <input type="radio" name="hair_type" value="lurus" class="peer hidden"
                            {{ old('hair_type') == 'lurus' ? 'checked' : '' }} >
                        <div class="border-2 border-gray-300 w-64 h-64 rounded-lg p-6 text-center transition-all hover:border-pink-400 peer-checked:border-pink-500 peer-checked:bg-pink-50">
                            <div class="aspect-square bg-white rounded-lg  flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets/images/lurus.png') }}" alt="Lurus" class="w-full h-full object-cover">
                            </div>
                            <p class="font-medium text-gray-900">Lurus</p>
                        </div>
                    </label>

                    <!-- Keriting -->
                    <label class="cursor-pointer w-64 h-64">
                        <input type="radio" name="hair_type" value="keriting" class="peer hidden"
                            {{ old('hair_type') == 'keriting' ? 'checked' : '' }} >
                        <div class="border-2 border-gray-300 w-64 h-64 rounded-lg p-6 text-center transition-all hover:border-pink-400 peer-checked:border-pink-500 peer-checked:bg-pink-50">
                            <div class="aspect-square bg-white rounded-lg flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('assets/images/kriting.png') }}" alt="Keriting" class="w-full h-full object-cover">
                            </div>
                            <p class="font-medium text-gray-900">Keriting</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Scalp Condition Section (Checkbox - dari database) -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 mb-2">Bagaimana Kondisi Kulit Kepala Anda ?</h2>
                <p class="text-sm text-gray-500 mb-4">Boleh pilih lebih dari satu</p>
                <div class="flex flex-wrap gap-3">
                    @foreach ($scalpConditions as $condition)
                        <label class="cursor-pointer">
                            <input type="checkbox"
                                   name="scalp_condition[]"
                                   value="{{ $condition->id }}"
                                   class="peer hidden"
                                   {{ in_array($condition->id, old('scalp_condition', [])) ? 'checked' : '' }}>
                            <div class="px-6 py-3 bg-pink-100 rounded-full font-medium text-gray-700 transition-all hover:bg-pink-200 peer-checked:bg-pink-500 peer-checked:text-white">
                                {{ $condition->name }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Two Column Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Hair Problem Section (Checkbox - dari database) -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-2">Apa Masalah Yang Sedang Rambut Anda Hadapi ?</h2>
                    <p class="text-sm text-gray-500 mb-4">Boleh pilih lebih dari satu</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 space-y-3 ">
                        @foreach ($hairProblems as $problem)
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox"
                                       name="hair_problem[]"
                                       value="{{ $problem->id }}"
                                       class="hidden peer"
                                       {{ in_array($problem->id, old('hair_problem', [])) ? 'checked' : '' }}>
                                <div class="w-full px-5 py-3 bg-pink-50 rounded-full font-medium text-gray-700 transition-all hover:bg-pink-100 peer-checked:bg-pink-200 flex items-center">
                                    <span class="w-5 h-5 rounded-full border-2 border-gray-400 mr-3 flex-shrink-0 peer-checked:border-pink-500 peer-checked:bg-pink-500"></span>
                                    {{ $problem->name }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Budget Section -->
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 mb-6">Berapa Budget Anda Untuk Produk Rambut ?</h2>
                    <div class="space-y-3">
                        <label class="cursor-pointer block">
                            <input type="radio" name="budget" value="terjangkau" class="hidden peer"
                                {{ old('budget') == 'terjangkau' ? 'checked' : '' }} >
                            <div class="px-6 py-4 bg-pink-50 rounded-lg transition-all hover:bg-pink-100 peer-checked:bg-pink-200 peer-checked:border-2 peer-checked:border-pink-500">
                                <p class="font-semibold text-gray-900">Rp 10.000 - 199.999</p>
                                <p class="text-sm text-gray-600">Budget Terjangkau</p>
                            </div>
                        </label>
                        <label class="cursor-pointer block">
                            <input type="radio" name="budget" value="medium" class="hidden peer"
                                {{ old('budget') == 'medium' ? 'checked' : '' }} >
                            <div class="px-6 py-4 bg-pink-50 rounded-lg transition-all hover:bg-pink-100 peer-checked:bg-pink-200 peer-checked:border-2 peer-checked:border-pink-500">
                                <p class="font-semibold text-gray-900">Rp 200.000 - 499.999</p>
                                <p class="text-sm text-gray-600">Budget Medium</p>
                            </div>
                        </label>
                        <label class="cursor-pointer block">
                            <input type="radio" name="budget" value="premium" class="hidden peer"
                                {{ old('budget') == 'premium' ? 'checked' : '' }} >
                            <div class="px-6 py-4 bg-pink-50 rounded-lg transition-all hover:bg-pink-100 peer-checked:bg-pink-200 peer-checked:border-2 peer-checked:border-pink-500">
                                <p class="font-semibold text-gray-900">Rp 500.000 - 1.000.000</p>
                                <p class="text-sm text-gray-600">Budget Premium</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Direct Recommendation Section -->
            <div class="bg-pink-100 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Rekomendasi Langsung :</h3>
                <div class="flex flex-wrap gap-3">
                    <a href="" class="px-6 py-3 bg-pink-300 hover:bg-pink-400 rounded-full font-medium text-gray-800 transition-all">
                        Untuk Rambut Berminyak
                    </a>
                    <a href="" class="px-6 py-3 bg-pink-300 hover:bg-pink-400 rounded-full font-medium text-gray-800 transition-all">
                        Untuk Rambut Kering
                    </a>
                    <a href="" class="px-6 py-3 bg-pink-300 hover:bg-pink-400 rounded-full font-medium text-gray-800 transition-all">
                        Untuk Rambut Rontok
                    </a>
                    <a href="" class="px-6 py-3 bg-pink-300 hover:bg-pink-400 rounded-full font-medium text-gray-800 transition-all">
                        Untuk Rambut Normal
                    </a>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="px-8 py-3 bg-pink-400 hover:bg-pink-500 text-white font-semibold rounded-full transition-all shadow-md hover:shadow-lg">
                    Selanjutnya
                </button>
            </div>
        </form>
    </div>
</div>
@endsection