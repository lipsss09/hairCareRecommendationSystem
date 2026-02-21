<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
class ProsesController extends Controller
{
    public function filterProducts(Request $request){
     $categoryId = $request->query('category_id');
    $sort = $request->query('sort');

    $query = Products::with('category');

    // Filter kategori
    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }

    // Sort harga
    if ($sort === 'asc') {
        $query->orderBy('price', 'asc');
    } elseif ($sort === 'desc') {
        $query->orderBy('price', 'desc');
    }

    // Default limit
    $products = $query->limit(8)->get();

    return response()->json($products);
    }
  
}
