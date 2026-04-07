<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HairCare | Login Page</title>
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
            <h2 id="heroText" class="text-2xl font-bold text-gray-700 mb-6 text-center">
                Hai! Ayo jelajahi fitur terbaik kami
            </h2>

            @if(session('success'))
            <div style="background:#d4edda;color:#155724;padding:10px;border-radius:5px;margin-bottom:15px;text-align:center;">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div style="background:#f8d7da;color:#721c24;padding:10px;border-radius:5px;margin-bottom:15px;text-align:center;">
                {{ session('error') }}
            </div>
            @endif


            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <div>
                    <input type="email" name="email"
                        class="w-full border bg-pink-50 border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan email Anda" required>
                </div>

                <div>
                    <input type="password" name="password"
                        class="w-full border bg-pink-50 border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-pink-400"
                        placeholder="Masukkan password" required>
                </div>

                <button type="submit"
                    class="w-full bg-pink-500 text-white py-3 rounded-lg hover:bg-pink-600 transition">
                    Masuk
                </button>
            </form>

            <p class="mt-6 text-sm text-gray-500 text-center">
                Belum punya akun?
                <a href="/register" class="text-pink-500 font-semibold">Daftar sekarang</a>
            </p>
        </div>

    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const textWrapper = document.getElementById("heroText");

    // Pecah huruf jadi span
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    // Animasi huruf
    anime({
        targets: '#heroText .letter',
        translateY: [{
                value: 0,
                duration: 400,
                easing: 'easeOutQuad'
            },
            {
                value: 0,
                duration: 400,
                easing: 'easeInQuad'
            }
        ],
        scale: [{
                value: 1.2,
                duration: 400,
                easing: 'easeOutQuad'
            },
            {
                value: 1,
                duration: 400,
                easing: 'easeInQuad'
            }
        ],
        delay: anime.stagger(70),
        loop: true,
        direction: 'alternate'
    });

});
</script>



</html>