<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\postCreateProduct;
use App\Http\Requests\postUpdateProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Product::all();
        return view('admin.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(postCreateProduct $request)
    {
        $product = $request->all();
        $product['image'] = $request->file('image')->store('product', 'public');

        Product::create($product);
        session()->flash('success', 'Товар ' . $request->get('name') . ' сохранен');
        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.form', compact(['product', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(postUpdateProduct $request, Product $product)
    {
        $productTotal = $request->all();

        if ($request->hasFile('image')) {
            $product->deletePhoto();
            $productTotal['image'] = $request->file('image')->store('product', 'public');
            Product::find($product->id)
                ->update($productTotal);
        } else {
            Product::find($product->id)
                ->update($productTotal);
        }

        session()->flash('success', 'Товар ' . $request->get('name') . ' сохранен');
        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->deleteProduct();
        session()->flash('warning', 'Товар ' . $product->name . ' удален');
        return redirect()->back();
    }

    public function product($codeCategory, $codeProduct)
    {
        $idCategory = Category::where('code', $codeCategory)->value('id');
        $product = Product::where('code',$codeProduct)
            ->where('category_id',$idCategory)->first();
        return view('product',compact(['product']));
    }
}
