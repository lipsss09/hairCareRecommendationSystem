<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Products;
use App\Models\Categories;
use App\Models\HairAssessment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // ==================== DASHBOARD ====================

    public function dashboard(): View
    {
        $totalUsers = User::count();
        $totalProducts = Products::count();

        // Top produk = produk yang paling banyak di-cart
        $topProduct = Products::withCount('carts')
            ->orderByDesc('carts_count')
            ->first();

        // Top kategori (jumlah produk per kategori, top 5)
        $topCategories = Categories::withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get();

        $categoryChart = [
            'names' => $topCategories->pluck('name')->toArray(),
            'counts' => $topCategories->pluck('products_count')->toArray(),
        ];

        // Riwayat interaksi (hair assessments terbaru)
        $recentAssessments = HairAssessment::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('content.admin.dashboard', compact(
            'totalUsers', 'totalProducts', 'topProduct',
            'categoryChart', 'recentAssessments'
        ));
    }

    // ==================== PRODUK CRUD ====================

    public function produk(): View
    {
        $products = Products::with('category')->orderBy('id', 'desc')->paginate(15);
        $categories = Categories::all();
        return view('content.admin.produk', compact('products', 'categories'));
    }

    public function storeProduk(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'size' => 'required|integer|min:0',
            'size_unit' => 'required|string|max:20',
            'ingredients' => 'required|string',
            'key_ingredients' => 'nullable|string',
            'image_url' => 'nullable|url',
            'source' => 'required|string',
        ]);

        // Generate product_id
        $data['product_id'] = 'PRD-' . strtoupper(uniqid());
        $data['collected_date'] = now()->toDateString();

        Products::create($data);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function updateProduk(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer|min:0',
            'size' => 'required|integer|min:0',
            'size_unit' => 'required|string|max:20',
            'image_url' => 'nullable|url',
        ]);

        $product->update($data);

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroyProduk($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil dihapus!');
    }

    // ==================== PENGGUNA CRUD ====================

    public function pengguna(): View
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        return view('content.admin.pengguna', compact('users'));
    }

    public function storePengguna(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function updatePengguna(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil diupdate!');
    }

    public function destroyPengguna($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil dihapus!');
    }

    // ==================== KATEGORI CRUD ====================

    public function kategori(): View
    {
        $categories = Categories::withCount('products')->orderBy('id', 'desc')->get();
        return view('content.admin.kategori', compact('categories'));
    }

    public function storeKategori(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Categories::create($data);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateKategori(Request $request, $id)
    {
        $category = Categories::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category->update($data);

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroyKategori($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
