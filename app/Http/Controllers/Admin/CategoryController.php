<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private \App\Services\ImageService $imageService)
    {
    }
    //
    public function index()
    {
        $categories = Category::orderBy('id', 'asc')->paginate('10');
        return view('admin.category.categories', compact('categories'));
    }
    // create
    public function create()
    {
        return view('admin.category.create');
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $category = new Category();

        $category->name = $request->name;
        $category->slug = $request->slug;
        if ($request->hasFile('image')) {
            $category->image = $this->imageService->uploadWithThumbnail(
                $request->file('image'),
                'assets/upload/category',
                'assets/upload/category/thumb',
            );
        }
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }
    // edit
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }
    // update
    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $category->name = $request->name;
        $category->slug = $request->slug;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($category->image && file_exists(public_path('assets/upload/category/' . $category->image))) {
                unlink(public_path('assets/upload/category/' . $category->image));
            }

            if ($category->image && file_exists(public_path('assets/upload/category/thumb/' . $category->image))) {
                unlink(public_path('assets/upload/category/thumb/' . $category->image));
            }

            $category->image = $this->imageService->uploadWithThumbnail(
                $request->file('image'),
                'assets/upload/category',
                'assets/upload/category/thumb',
            );
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }
    // destroy
    public function destroy(Category $category)
    {
        $category->delete();
        if ($category->image && file_exists(public_path('assets/upload/category/' . $category->image))) {
            File::delete(public_path('assets/upload/category/' . $category->image));
        }
        if ($category->image && file_exists(public_path('assets/upload/category/thumb/' . $category->image))) {
            File::delete(public_path('assets/upload/category/thumb/' . $category->image));
        }
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
