<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\postCreateCategory;
use App\Http\Requests\postUpdateCategory;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::all();
        return view('admin.categories.index', compact(['list']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(postCreateCategory $request)
    {
        Category::create([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'image' => 'category/' . $request->file('image')->hashName(),
        ]);
        $request->file('image')->store('category/', 'public');
        session()->flash('success', 'Категория ' . $request->get('name') . ' сохранена');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(postUpdateCategory $request, Category $category)
    {
        if ($request->hasFile('image')) {
            Category::where('id', $category->id)
                ->update([
                    'code' => $request->get('code'),
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                    'image' => 'category/' . $request->file('image')->hashName(),
                ]);
            Storage::disk('public')->delete($category->image);
            $request->file('image')->store('category/', 'public');
        } else {
            Category::where('id', $category->id)
                ->update([
                    'code' => $request->get('code'),
                    'name' => $request->get('name'),
                    'description' => $request->get('description'),
                ]);
        }
        session()->flash('success', 'Категория ' . $request->get('name') . ' сохранена');
        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $products = Product::where('category_id', $category->id)->get();
        foreach ($products as $product)
        {
            Storage::disk('public')->delete($product->image);
            $product->delete();
        }
        Storage::disk('public')->delete($category->image);
        $category->delete();
        session()->flash('warning', 'Категория ' . $category->name . ' удалена');
        return redirect()->back();
    }

    public function category($codeCategory)
    {
        $category = Category::where('code', $codeCategory)->first();
        return view('category', compact(['category']));
    }
}
