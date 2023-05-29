<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Category.index', ['categories' => Category::orderBy('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|alpha|max:35|unique:categories'
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('Category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|alpha|max:35|unique:categories,name,' . $category->id
        ]);

        $category->name = $validated['name'];
        $category->save();

        if ($category->wasChanged('name')) {
            return redirect()->route('category.index')->with('status', 'Категория успешно изменена');
        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('status', "Категория $category->name успешно удалена");
    }
}
