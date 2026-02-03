<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HairCare | Register Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-pink-100 min-h-screen flex items-center justify-center">

    <div
        class="w-full max-w-5xl h-[600px] bg-white rounded-2xl shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <!-- Left Side -->
        <div class="relative hidden md:block">
            <img src="{{ asset('assets/images/logo.png') }}" class="absolute inset-0 w-full h-full object-cover"
                alt="HairCare Image">
        </div>


        <!-- Right Side (Form) -->
        <div class="p-10 flex flex-col justify-center">
            <h2 id="heroText" class="text-2xl font-bold text-gray-700 mb-6 text-center">Ayo! Mulai buat akun anda</h2>

            @if(session('error'))
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/register" class="space-y-4">
                @csrf

                <div class="mb-5">
                    <input type="text" name="nama_lengkap"
                        class="w-full border bg-pink-50 border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan nama lengkap Anda" required>
                </div>
                <div>
                    <input type="text" name="username"
                        class="w-full border bg-pink-50 border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan username Anda" required>
                </div>

                <div>
                    <input type="email" name="email"
                        class="w-full border bg-pink-50 border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan email Anda" required>
                </div>

                <div>
                    <input type="password" name="password"
                        class="w-full border bg-pink-50 border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan password" required>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div>
                    <input type="password" name="password_confirmation"
                        class="w-full border bg-pink-50 border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Konfirmasi password" required>
                    @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <button type="submit"
                    class="w-full bg-pink-500 text-white py-3 rounded-lg hover:bg-pink-600 transition">
                    Daftar
                </button>
            </form>

            <p class="mt-6 text-sm text-gray-500 text-center">
                Sudah memiliki akun?
                <a href="/login" class="text-pink-500 font-semibold">Masuk Sekarang</a>
            </p>
        </div>

    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const textWrapper = document.getElementById("heroText");

    // Pecah huruf jadi span
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    // Animasi huruf
    anime({
        targets: '#heroText .letter',
        translateY: [
            { value: -20, duration: 300, easing: 'easeOutQuad' },
            { value: 0, duration: 300, easing: 'easeInQuad' }
        ],
        scale: [
            { value: 1.2, duration: 300, easing: 'easeOutQuad' },
            { value: 1, duration: 300, easing: 'easeInQuad' }
        ],
        delay: anime.stagger(70),
        loop: true,
        direction: 'alternate'
    });

});
</script>


</html>