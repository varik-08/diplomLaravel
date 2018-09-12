<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class FaceController extends Controller
{
    public function category($codeCategory)
    {
        $category = Category::where('code', $codeCategory)->first();
        return view('category', compact(['category']));
    }

    public function product($codeCategory, $codeProduct)
    {
        $idCategory = Category::where('code', $codeCategory)->value('id');
        $product = Product::where('code', $codeProduct)
            ->where('category_id', $idCategory)->first();
        return view('product', compact(['product']));
    }

    public function productShowUser()
    {
        $products = Product::all();
        return view('products', compact(['products']));
    }

    public function categoryShowUser()
    {
        $categories = Category::all();
        return view('categories', compact(['categories']));
    }
}
