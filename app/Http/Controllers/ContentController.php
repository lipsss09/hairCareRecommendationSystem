<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Categories;
use App\Models\Products;

class ContentController extends Controller
{
    public function hairProblem(): View
    {
        return view ('content.hairProblem');
    }

    public function dashboard(): View
    {
        $categories = Categories::all();
        $products = Products::limit(8)->orderBy('product_id', 'asc')->with('category')->get();
        return view('content.dashboard', compact('categories','products'));
    }
}
