<nav class="bg-pink-200  px-6 py-3 shadow-md bg-gradient-to-r from-pink-200 to-pink-100">

    <div class="max-w-8xl mx-auto flex items-center justify-between">

        <!-- LEFT: Logo -->
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/images/icon.png') }}" class="h-10 w-10" alt="logo">
            <a href="{{ route('dashboard') }}" class="text-pink-300 font-bold text-xl">Hair Care</a>

        </div>

        <!-- MIDDLE: Menu -->
        <div class="hidden md:flex gap-8 text-gray-700 font-medium">
            <a href="#" class="hover:text-pink-600">Beranda</a>
            <a href="#" class="hover:text-pink-600">Permasalahan</a>
            <a href="#" class="hover:text-pink-600">Rekomendasi</a>
            <a href="#" class="hover:text-pink-600">Tentang</a>
            <a href="#" class="hover:text-pink-600">Kontak</a>
        </div>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- Search -->


            <!-- Icons -->
            <button class="bg-white p-2 rounded-full shadow-sm hover:bg-gray-100">
                <i class="fa-solid fa-right-from-bracket size-6"></i>
            </button>

            <button class="bg-white p-2 rounded-full shadow-sm hover:bg-gray-100">
                <i class="fa-solid fa-magnifying-glass size-6"></i>
            </button>

            <!-- Avatar -->
            <div class="relative">
                <button id="profileBtn" class="focus:outline-none">
                    <img src="{{asset('assets/images/livi.png')}}"
                        class="w-9 h-9 rounded-full border-2 border-white shadow-md">
                </button>

                <!-- DROPDOWN -->
                <div id="profileDropdown"
                    class="hidden absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-xl p-4 z-50 ">

                    <!-- HEADER -->
                    <div class="flex items-center gap-3 bg-pink-100 p-3 rounded-xl">

                        <img src="{{asset('assets/images/livi.png')}}" class="w-12 h-12 rounded-full border">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-700">{{ auth()->user()->username }}</p>
                            <p class="text-xs text-gray-500">User</p>
                        </div>

                    </div>

                    <!-- ACTIONS -->
                    <div class="mt-4 space-y-2">
                        <button id="editButton"
                            class="w-full flex items-center gap-2 bg-gray-100 hover:bg-pink-100 p-2 rounded-lg transition">
                            <i class="fa-solid fa-pen text-pink-500"></i> Edit Profil
                        </button>


                        <a href="#"
                            class="flex items-center gap-2 bg-gray-100 hover:bg-pink-100 p-2 rounded-lg transition">
                            <button type="button" id="recButton"></button>
                            <i class="fa-solid fa-book text-pink-500"></i> Recommendation
                        </a>

                        <form method="POST" action="/logout">
                            @csrf
                            <button
                                class="w-full flex items-center gap-2 bg-red-100 hover:bg-red-200 p-2 rounded-lg text-red-600">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- EDIT PROFILE MODAL -->
<div id="editModal"
    class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">

    <div class="bg-white w-[420px] rounded-2xl shadow-xl p-6 relative animate-scale">

        <h2 class="text-center text-xl font-bold text-pink-500 mb-4">Edit Profile</h2>

        <!-- Close -->
        <button id="closeModal"
            class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-xl">&times;</button>

        <div class="flex flex-col items-center mb-4">
            <img src="{{asset('assets/images/livi.png')}}"
                class="w-20 h-20 rounded-full border mb-2">
            <button class="bg-pink-100 text-pink-600 px-3 py-1 rounded-lg text-sm">Ubah Foto</button>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-3">
            @csrf
           
            <input type="text" value="{{ auth()->user()->name }}"
                class="w-full border rounded-lg px-3 py-2" name="nama_lengkap">

             <input type="text" value="{{ auth()->user()->username }}"
                class="w-full border rounded-lg px-3 py-2" name="username">

            <input type="email" value="{{ auth()->user()->email }}"
                class="w-full border rounded-lg px-3 py-2" name="email">

            <input type="password" placeholder="Password baru"
                class="w-full border rounded-lg px-3 py-2" name="password">

            <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600">
                Simpan
            </button>
        </form>
    </div>
</div>
</nav>
