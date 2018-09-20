<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class FaceController extends Controller
{
    public function category($codeCategory)
    {
        $category = Category::where('code', $codeCategory)->firstOrFail();
        return view('category', compact('category'));
    }

    public function product($codeCategory, $codeProduct)
    {
        $product = Category::where('code', $codeCategory)->firstOrFail()->products()->where('code', $codeProduct)->firstOrFail();
        return view('product', compact('product'));
    }

    public function productShowUser()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function categoryShowUser()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }
}
