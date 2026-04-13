@extends('layout.app')

@section('title', 'Tentang Perawatan Rambut Kami')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-pink-100 via-white to-pink-50 overflow-hidden min-h-[60vh] flex items-center">
    <!-- Decorative Bloom -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10 w-full flex flex-col items-center text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-500 mb-6 drop-shadow-sm">
            Temukan Rahasia Rambut Indahmu
        </h1>
        <p class="text-lg md:text-xl text-gray-600 max-w-3xl mb-10 leading-relaxed font-light">
            Kami menggabungkan analisis personal dengan rekomendasi berbasis kecerdasan komputasi. Mencari solusi untuk rambut rontok, berminyak, bercabang, atau gatal kini menjadi lebih akurat.
        </p>
        <a href="{{ route('permasalahan') }}" class="group relative px-8 py-4 bg-pink-500 text-white font-bold rounded-full shadow-[0_10px_40px_rgba(236,72,153,0.4)] hover:shadow-[0_15px_50px_rgba(236,72,153,0.6)] hover:bg-pink-600 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
            <span class="relative z-10 flex items-center gap-2">Mulai Analisis Rambut <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i></span>
        </a>
    </div>
</section>

<!-- Features Section -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Mengapa Memilih Kami?</h2>
            <div class="w-16 h-1 bg-pink-400 mx-auto rounded"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-10">
            <!-- Feature 1 -->
            <div class="animate-item bg-gradient-to-b from-white to-pink-50/50 p-8 rounded-3xl shadow-lg border border-pink-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-500 transition-colors duration-300">
                    <i class="fa-solid fa-microscope text-2xl text-pink-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Analisis Bahan Aktif</h3>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Mesin rekomendasi kami membongkar ratusan produk hingga ke akar bahannya, mencocokkan setiap senyawa kimia dengan kondisi rambut.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="animate-item bg-gradient-to-b from-white to-pink-50/50 p-8 rounded-3xl shadow-lg border border-pink-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-500 transition-colors duration-300">
                    <i class="fa-solid fa-hand-holding-heart text-2xl text-pink-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Sangat Personal</h3>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Tidak ada rambut yang sama. Rekomendasi dihitung spesifik berdasarkan paduan keluhan unik rambut dan kulit kepala Anda.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="animate-item bg-gradient-to-b from-white to-pink-50/50 p-8 rounded-3xl shadow-lg border border-pink-100 hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group">
                <div class="w-16 h-16 bg-pink-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-pink-500 transition-colors duration-300">
                    <i class="fa-solid fa-clock-rotate-left text-2xl text-pink-500 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Simpan Evaluasi</h3>
                <p class="text-gray-600 leading-relaxed text-sm">
                    Pantau kondisi rambut Anda dari waktu ke waktu. Seluruh histori konsultasi tersimpan rapi untuk panduan belanja di masa mendatang.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-24 bg-pink-50 rounded-t-[3rem]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <div class="rounded-3xl shadow-2xl z-10 relative overflow-hidden w-full h-[400px] bg-white flex items-center justify-center p-8">
                        <img src="{{ asset('assets/images/products/P001.png') }}" class="slide-img absolute object-contain w-full h-full p-8 transition-opacity duration-1000 opacity-100" alt="Produk 1">
                        <img src="{{ asset('assets/images/products/P010.png') }}" class="slide-img absolute object-contain w-full h-full p-8 transition-opacity duration-1000 opacity-0" alt="Produk 2">
                        <img src="{{ asset('assets/images/products/P025.png') }}" class="slide-img absolute object-contain w-full h-full p-8 transition-opacity duration-1000 opacity-0" alt="Produk 3">
                        <img src="{{ asset('assets/images/products/P050.png') }}" class="slide-img absolute object-contain w-full h-full p-8 transition-opacity duration-1000 opacity-0" alt="Produk 4">
                        <img src="{{ asset('assets/images/products/P100.png') }}" class="slide-img absolute object-contain w-full h-full p-8 transition-opacity duration-1000 opacity-0" alt="Produk 5">
                        <img src="{{ asset('assets/images/products/P150.png') }}" class="slide-img absolute object-contain w-full h-full p-8 transition-opacity duration-1000 opacity-0" alt="Produk 6">
                        
                        <div class="absolute inset-0 bg-gradient-to-tr from-pink-500/10 to-transparent z-20"></div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-full h-full bg-pink-200 rounded-3xl -z-10"></div>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">Hanya 3 Langkah Menuju Rambut Sempurna</h2>
                
                <div class="space-y-8">
                    <div class="animate-item flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white shadow flex items-center justify-center text-pink-500 font-bold text-xl border-2 border-pink-100">1</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Kenali Masalah Anda</h4>
                            <p class="text-gray-600">Jawab beberapa pertanyaan singkat mengenai tipe rambut, masalah, serta sensitivitas kulit kepala Anda.</p>
                        </div>
                    </div>
                    
                    <div class="animate-item flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white shadow flex items-center justify-center text-pink-500 font-bold text-xl border-2 border-pink-100">2</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Sistem Bekerja</h4>
                            <p class="text-gray-600">Algoritma cerdas kami mengambil alih, mencocokkan keluhan dengan kandungan ratusan produk terbaik di kelasnya.</p>
                        </div>
                    </div>

                    <div class="animate-item flex gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-pink-500 flex items-center justify-center text-white shadow-lg font-bold text-xl shadow-pink-500/50">3</div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Dapatkan Produk</h4>
                            <p class="text-gray-600">Simpan hasil evalusi dan mulailah perjalanan anda menggunakan produk perawatan rekomendasi yang pasti cocok.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Custom Styles for Animations -->
<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const slides = document.querySelectorAll('.slide-img');
        if(slides.length === 0) return;
        
        let currentIdx = 0;
        setInterval(() => {
            // Hilangkan gambar saat ini
            slides[currentIdx].classList.remove('opacity-100');
            slides[currentIdx].classList.add('opacity-0');
            
            // Pindah ke gambar selanjutnya
            currentIdx = (currentIdx + 1) % slides.length;
            
            // Munculkan gambar baru
            slides[currentIdx].classList.remove('opacity-0');
            slides[currentIdx].classList.add('opacity-100');
        }, 3000); // ganti setiap 3 detik
    });
</script>
@endsection
