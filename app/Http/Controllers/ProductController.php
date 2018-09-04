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
        Product::create([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'description' => $request->get('description'),
            'image' => 'product/' . $request->file('image')->hashName(),
            'price' => $request->get('price'),
        ]);
        $request->file('image')->store('product/', 'public');
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
        if ($request->hasFile('image')) {
            Product::where('id', $product->id)
                ->update([
                    'code' => $request->get('code'),
                    'name' => $request->get('name'),
                    'category_id' => $request->get('category_id'),
                    'description' => $request->get('description'),
                    'image' => 'product/' . $request->file('image')->hashName(),
                    'price' => $request->get('price'),
                ]);
            Storage::disk('public')->delete($product->image);
            $request->file('image')->store('product/', 'public');
        } else {
            Product::where('id', $product->id)
                ->update([
                    'code' => $request->get('code'),
                    'name' => $request->get('name'),
                    'category_id' => $request->get('category_id'),
                    'description' => $request->get('description'),
                    'price' => $request->get('price'),
                ]);
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
        Storage::disk('public')->delete($product->image);
        $product->delete();
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
