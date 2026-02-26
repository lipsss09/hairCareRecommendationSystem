<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Kembalikan isi keranjang user saat ini sebagai JSON (untuk modal)
    public function index()
    {
        $cartItems = Cart::with('product.category')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->quantity * ($item->product->price ?? 0));

        return response()->json([
            'items' => $cartItems,
            'total' => $total,
        ]);
    }

    // Tambah produk ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string|exists:products,product_id',
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
        }
        else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        $count = Cart::where('user_id', Auth::id())->sum('quantity');

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $count,
        ]);
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $item = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();

        $cartItems = Cart::with('product.category')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->quantity * ($item->product->price ?? 0));
        $count = $cartItems->sum('quantity');

        return response()->json([
            'success' => true,
            'items' => $cartItems,
            'total' => $total,
            'cart_count' => $count,
        ]);
    }
}
