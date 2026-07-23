<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();
        
        $query = Product::with('subcategory.category');
        
        if ($request->has('category') && $request->category !== 'all') {
            $catName = strtolower($request->category);
            $query->whereHas('subcategory.category', function ($q) use ($catName) {
                // Assuming category name is matched case-insensitively
                $q->whereRaw('LOWER(name) = ?', [$catName]);
            });
        }
        
        $products = $query->simplePaginate(12)->withQueryString();
        
        $addOns = \App\Models\AddOn::all();

        return view('front.home', compact('categories', 'products', 'addOns'));
    }
}
