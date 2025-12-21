<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use File;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function __construct(private \App\Services\ImageService $imageService)
    {
    }
    // index
    public function index()
    {
        $brands = Brand::orderBy('id', 'asc')->paginate('10');
        return view('admin.brand.brands', compact('brands'));
    }
    // create
    public function create()
    {
        return view('admin.brand.create');
    }
    // store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $brand = new Brand;

        $brand->name = $request->name;
        $brand->slug = $request->slug;
        if ($request->hasFile('image')) {
            $brand->image = $this->imageService->uploadWithThumbnail(
                $request->file('image'),
                'assets/upload/brand',
                'assets/upload/brand/thumb',
            );
        }
        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand created successfully');
    }
    // edit
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }
    // update
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $brand->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $brand->name = $request->name;
        $brand->slug = $request->slug;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($brand->image && file_exists(public_path('assets/upload/brand/' . $brand->image))) {
                unlink(public_path('assets/upload/brand/' . $brand->image));
            }

            if ($brand->image && file_exists(public_path('assets/upload/brand/thumb/' . $brand->image))) {
                unlink(public_path('assets/upload/brand/thumb/' . $brand->image));
            }

            $brand->image = $this->imageService->uploadWithThumbnail(
                $request->file('image'),
                'assets/upload/brand',
                'assets/upload/brand/thumb',
            );
        }

        $brand->save();

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }
    // destroy
    public function destroy(Brand $brand)
    {
        $brand->delete();
        if ($brand->image && file_exists(public_path('assets/upload/brand/' . $brand->image))) {
            File::delete(public_path('assets/upload/brand/' . $brand->image));
        }
        if ($brand->image && file_exists(public_path('assets/upload/brand/thumb/' . $brand->image))) {
            File::delete(public_path('assets/upload/brand/thumb/' . $brand->image));
        }
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully');
    }
}