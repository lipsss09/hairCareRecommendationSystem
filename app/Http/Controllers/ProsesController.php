<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
class ProsesController extends Controller
{
    public function filterProducts(Request $request){
     $categoryId = $request->query('category_id');
    $sort = $request->query('sort');
    $filter = $request->query('filter');

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
    if($filter ==='all'){
        $query->limit(300); // Atau sesuaikan dengan jumlah total produk
    } else {
        $query->limit(8);
    }
    $products = $query->get();

    
    return response()->json($products);
    }
  
}
