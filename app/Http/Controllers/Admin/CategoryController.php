<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\postCreateCategory;
use App\Http\Requests\postUpdateCategory;
use App\Http\Controllers\Controller;

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
        $category = $request->all();
        $category['image'] = $request->file('image')->store('category', 'public');

        Category::create($category);
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
        $categoryTotal = $request->all();

        if ($request->hasFile('image')) {
            $category->deletePhoto();
            $categoryTotal['image'] = $request->file('image')->store('category', 'public');
        }
        Category::find($category->id)
            ->update($categoryTotal);
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
        $category->deleteCategory();
        session()->flash('warning', 'Категория ' . $category->name . ' удалена');
        return redirect()->back();
    }
}
