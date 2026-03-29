@extends('layout.admin')

@section('title', 'Manajemen Produk')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Produk</h1>
    <button onclick="openModal('addModal')"
        class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-plus"></i> Tambah Produk
    </button>
</div>

{{-- FLASH MESSAGE --}}
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
    {{ session('success') }}
</div>
@endif

{{-- TABLE --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">#</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Gambar</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Nama</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Brand</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Kategori</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Harga</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $i => $product)
                <tr class="border-b border-gray-100 hover:bg-pink-50/50 transition-colors">
                    <td class="py-3 px-4 text-gray-500">{{ $products->firstItem() + $i }}</td>
                    <td class="py-3 px-4">
                        <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}"
                             class="w-12 h-12 object-contain rounded-lg bg-pink-50">
                    </td>
                    <td class="py-3 px-4 text-gray-700 font-medium">{{ $product->name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $product->brand }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $product->category->name ?? '-' }}</td>
                    <td class="py-3 px-4 text-gray-700 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openEditProduct({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ addslashes($product->brand) }}', {{ $product->category_id }}, {{ $product->price }}, {{ $product->size }}, '{{ $product->size_unit }}', '{{ addslashes($product->image_url) }}')"
                                class="text-blue-500 hover:text-blue-700 p-1.5 rounded-lg hover:bg-blue-50 transition">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.produk.destroy', $product->id) }}"
                                  onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-700 p-1.5 rounded-lg hover:bg-red-50 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-gray-400">Belum ada data produk</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($products->hasPages())
    <div class="px-4 py-3 border-t border-gray-100">
        {{ $products->links() }}
    </div>
    @endif
</div>

{{-- ADD MODAL --}}
<div id="addModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white w-[500px] max-h-[90vh] overflow-y-auto rounded-2xl shadow-xl p-6 relative">
        <h2 class="text-xl font-bold text-pink-500 mb-4">Tambah Produk</h2>
        <button onclick="closeModal('addModal')" class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-xl">&times;</button>

        <form method="POST" action="{{ route('admin.produk.store') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                <input type="text" name="brand" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" required class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" name="price" required class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                    <div class="flex gap-2">
                        <input type="number" name="size" required class="w-full border rounded-lg px-3 py-2 text-sm">
                        <input type="text" name="size_unit" placeholder="ml" required class="w-20 border rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                <input type="url" name="image_url" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Source URL</label>
                <input type="url" name="source" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ingredients</label>
                <textarea name="ingredients" rows="2" required class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Key Ingredients</label>
                <textarea name="key_ingredients" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">
                Simpan Produk
            </button>
        </form>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white w-[500px] max-h-[90vh] overflow-y-auto rounded-2xl shadow-xl p-6 relative">
        <h2 class="text-xl font-bold text-pink-500 mb-4">Edit Produk</h2>
        <button onclick="closeModal('editModal')" class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-xl">&times;</button>

        <form id="editForm" method="POST" class="space-y-3">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="name" id="editName" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                <input type="text" name="brand" id="editBrand" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" id="editCategoryId" required class="w-full border rounded-lg px-3 py-2 text-sm">
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                    <input type="number" name="price" id="editPrice" required class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                    <div class="flex gap-2">
                        <input type="number" name="size" id="editSize" required class="w-full border rounded-lg px-3 py-2 text-sm">
                        <input type="text" name="size_unit" id="editSizeUnit" required class="w-20 border rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
                <input type="url" name="image_url" id="editImageUrl" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">
                Update Produk
            </button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openModal(id) {
        const m = document.getElementById(id);
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    function closeModal(id) {
        const m = document.getElementById(id);
        m.classList.add('hidden');
        m.classList.remove('flex');
    }
    function openEditProduct(id, name, brand, categoryId, price, size, sizeUnit, imageUrl) {
        document.getElementById('editForm').action = '/admin/produk/' + id;
        document.getElementById('editName').value = name;
        document.getElementById('editBrand').value = brand;
        document.getElementById('editCategoryId').value = categoryId;
        document.getElementById('editPrice').value = price;
        document.getElementById('editSize').value = size;
        document.getElementById('editSizeUnit').value = sizeUnit;
        document.getElementById('editImageUrl').value = imageUrl;
        openModal('editModal');
    }
</script>
@endsection
