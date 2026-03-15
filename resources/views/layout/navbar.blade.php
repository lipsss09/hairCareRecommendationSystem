<nav class="bg-pink-200 px-6 py-3 bg-gradient-to-r from-pink-200 to-pink-100 relative shadow-[0_8px_30px_rgb(0,0,0,0.12)] border-b-2 border-pink-300">

    <div class="max-w-8xl mx-auto flex items-center justify-between">

        <!-- LEFT: Logo -->
        <div class="flex items-center gap-2">
            <img src="{{ asset('assets/images/icon.png') }}" class="h-10 w-10" alt="logo">
          <a href="{{ route('dashboard') }}"
   class="font-bold text-xl bg-gradient-to-r from-pink-400 via-pink-500 to-pink-300 bg-clip-text text-transparent">
   Hair Care

</a>


        </div>

        <!-- MIDDLE: Menu -->
        <div class="hidden md:flex gap-8 text-gray-700 font-medium">
            <a href="/dashboard" class="hover:text-pink-600">Beranda</a>
            <a href="/permasalahan" class="hover:text-pink-600">Permasalahan</a>
            <a href="#" class="hover:text-pink-600">Rekomendasi</a>
            <a href="#" class="hover:text-pink-600">Tentang</a>
            <a href="#" class="hover:text-pink-600">Kontak</a>
        </div>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- Cart Button -->
            <button id="cartBtn" class="bg-white p-2 rounded-full shadow-sm hover:bg-gray-100 relative">
                <i class="fa-solid fa-cart-shopping size-6"></i>
                @php $cartCount = auth()->user()->carts()->sum('quantity'); @endphp
                <span id="cartBadge"
                    class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center
                    {{ $cartCount > 0 ? '' : 'hidden' }}">
                    {{ $cartCount }}
                </span>
            </button>

            <!-- Logout -->
            <button class="bg-white p-2 rounded-full shadow-sm hover:bg-gray-100">
                <i class="fa-solid fa-right-from-bracket size-6"></i>
            </button>

            <!-- Avatar -->
            <div class="relative">
                <button id="profileBtn" class="focus:outline-none">
                    <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('assets/images/livi.png') }}"
                        class="w-9 h-9 rounded-full border-2 border-white shadow-md">
                </button>

                <!-- DROPDOWN -->
                <div id="profileDropdown"
                    class="hidden absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-xl p-4 z-50 ">

                    <!-- HEADER -->
                    <div class="flex items-center gap-3 bg-pink-100 p-3 rounded-xl">

                        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('assets/images/livi.png') }}" class="w-12 h-12 rounded-full border">
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

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-3" enctype="multipart/form-data">
            @csrf
           <div class="flex flex-col items-center mb-4">
            <img id="profilePreview" src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('assets/images/livi.png') }}"
                class="w-20 h-20 rounded-full border mb-2 object-cover">
            <label for="profile_picture" class="bg-pink-100 text-pink-600 px-3 py-1 rounded-lg text-sm cursor-pointer hover:bg-pink-200 transition">Ubah Foto
                <input type="file" class="hidden" name="profile_picture" id="profile_picture" accept="image/*">
            </label>
        </div>
            <input type="text" value="{{ auth()->user()->name }}"
                class="w-full border rounded-lg px-3 py-2" name="nama_lengkap">
            <input type="hidden" value="{{ auth()->user()->id }}" name="id">
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

<!-- ===================== CART MODAL ===================== -->
<div id="cartModal" class="fixed inset-0 z-[60] hidden">
    <!-- Backdrop -->
    <div id="cartBackdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Panel - slide from right -->
    <div id="cartPanel"
        class="absolute right-0 top-0 h-full w-full max-w-md bg-white shadow-2xl flex flex-col translate-x-full transition-transform duration-300 ease-in-out">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-pink-500 to-pink-400">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-cart-shopping text-white text-xl"></i>
                <h2 class="text-white font-bold text-xl">Keranjang Saya</h2>
            </div>
            <button id="closeCartBtn" class="text-white hover:text-pink-200 text-2xl leading-none">&times;</button>
        </div>

        <!-- Cart Items -->
        <div id="cartItems" class="flex-1 overflow-y-auto px-6 py-4 space-y-4">
            <!-- Items will be injected here by JS -->
        </div>

        <!-- Footer: total + checkout placeholder -->
        <div class="border-t px-6 py-4 bg-gray-50">
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-600 font-medium">Total</span>
                <span id="cartTotal" class="text-gray-800 font-bold text-xl">Rp 0</span>
            </div>
            <button class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-3 rounded-xl transition-colors">
                Checkout
            </button>
        </div>
    </div>
</div>

<!-- ===================== TOAST NOTIFICATION ===================== -->
<div id="toast"
    class="fixed top-6 right-0 z-[70] transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="bg-white border border-pink-200 shadow-xl rounded-xl px-5 py-4 flex items-center gap-3 min-w-[260px]">
        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center shrink-0">
            <i class="fa-solid fa-check text-green-500 text-sm"></i>
        </div>
        <p id="toastMessage" class="text-gray-700 text-sm font-medium"></p>
    </div>
</div>

<script>
    // ---- Profile dropdown ----
    document.getElementById('profileBtn').addEventListener('click', function (e) {
        e.stopPropagation();
        document.getElementById('profileDropdown').classList.toggle('hidden');
    });
    document.addEventListener('click', function () {
        document.getElementById('profileDropdown').classList.add('hidden');
    });

    // ---- Edit Profile Modal ----
    document.getElementById('editButton').addEventListener('click', function () {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });
    document.getElementById('closeModal').addEventListener('click', function () {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    // Profile picture preview
    document.getElementById('profile_picture').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('profilePreview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // ---- Cart Modal ----
    const cartModal  = document.getElementById('cartModal');
    const cartPanel  = document.getElementById('cartPanel');
    const cartBadge  = document.getElementById('cartBadge');

    function openCartModal() {
        cartModal.classList.remove('hidden');
        // Allow display:block to paint before slide-in
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                cartPanel.classList.remove('translate-x-full');
            });
        });
        loadCartItems();
    }

    function closeCartModal() {
        cartPanel.classList.add('translate-x-full');
        setTimeout(() => cartModal.classList.add('hidden'), 300);
    }

    document.getElementById('cartBtn').addEventListener('click', openCartModal);
    document.getElementById('closeCartBtn').addEventListener('click', closeCartModal);
    document.getElementById('cartBackdrop').addEventListener('click', closeCartModal);

    function formatRupiah(number) {
        return 'Rp ' + parseInt(number).toLocaleString('id-ID');
    }

    function loadCartItems() {
        fetch('{{ route("cart.index") }}', {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            renderCartItems(data.items, data.total);
        });
    }

    function renderCartItems(items, total) {
        const container = document.getElementById('cartItems');
        const totalEl   = document.getElementById('cartTotal');

        if (!items || items.length === 0) {
            container.innerHTML = `
                <div class="flex flex-col items-center justify-center h-full text-gray-400 py-16">
                    <i class="fa-solid fa-cart-shopping text-5xl mb-4 text-pink-200"></i>
                    <p class="text-lg font-medium">Keranjang masih kosong</p>
                    <p class="text-sm mt-1">Tambahkan produk dari halaman produk</p>
                </div>`;
            totalEl.textContent = 'Rp 0';
            return;
        }

        container.innerHTML = items.map(item => {
            const product = item.product;
            const subtotal = item.quantity * product.price;
            return `
            <div class="flex items-center gap-4 bg-pink-50 rounded-xl p-3 border border-pink-100" data-id="${item.id}">
                <img src="${product.image_url || ''}" alt="${product.name}"
                     class="w-16 h-16 object-cover rounded-lg border border-pink-200">
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-800 text-sm truncate">${product.name}</p>
                    <p class="text-xs text-gray-500">${product.category ? product.category.name : ''}</p>
                    <p class="text-pink-500 font-bold text-sm mt-1">${formatRupiah(product.price)}</p>
                    <p class="text-xs text-gray-400">Qty: ${item.quantity} &nbsp;&bull;&nbsp; ${formatRupiah(subtotal)}</p>
                </div>
                <button onclick="removeCartItem(${item.id})"
                    class="text-red-400 hover:text-red-600 transition p-1 rounded-full hover:bg-red-50">
                    <i class="fa-solid fa-trash text-sm"></i>
                </button>
            </div>`;
        }).join('');

        totalEl.textContent = formatRupiah(total);
    }

    function removeCartItem(id) {
        fetch(`/cart/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(r => r.json())
        .then(data => {
            updateBadge(data.cart_count);
            renderCartItems(data.items, data.total);
        });
    }

    function updateBadge(count) {
        if (count > 0) {
            cartBadge.textContent = count;
            cartBadge.classList.remove('hidden');
        } else {
            cartBadge.classList.add('hidden');
        }
    }

    // ---- Toast ----
    function showToast(message) {
        const toast = document.getElementById('toast');
        document.getElementById('toastMessage').textContent = message;
        toast.classList.remove('translate-x-full');
        setTimeout(() => toast.classList.add('translate-x-full'), 3000);
    }

    // ---- Add to Cart (called from product cards) ----
    function addToCart(productId, btn) {
        btn.disabled = true;
        fetch('{{ route("cart.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                showToast(data.message);
                updateBadge(data.cart_count);
            }
        })
        .finally(() => { btn.disabled = false; });
    }
</script>
