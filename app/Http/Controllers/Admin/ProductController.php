<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use File;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private \App\Services\ImageService $imageService)
    {
    }

    // index
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(15);
        return view('admin.product.products', compact('products'));
    }

    // create
    public function create()
    {
        $brands = Brand::orderBy('id', 'asc')->get();
        $categories = Category::orderBy('id', 'asc')->get();

        return view('admin.product.create', compact('brands', 'categories'));
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'SKU' => 'required|string|max:50|unique:products,SKU',
            'quantity' => 'required|integer|min:0',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'required|boolean',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = $this->imageService->uploadWithThumbnail(
                $request->file('image'),
                'assets/upload/product',
                'assets/upload/product/thumb',
            );
        }

        $galleryImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $galleryImage) {
                $gName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('uploads/products/gallery'), $gName);
                $galleryImages[] = $gName;
            }
        }

        $product = Product::create([
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'] ?? null,
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'SKU' => $validated['SKU'],
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'image' => $imageName,
            'images' => $galleryImages,
            'price' => $validated['regular_price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock' => $validated['quantity'],
            'in_stock' => $validated['stock_status'] === 'instock',
            'featured' => $validated['featured'],
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    // edit
    public function edit(Product $product)
    {
        $brands = Brand::orderBy('id', 'asc')->get();
        $categories = Category::orderBy('id', 'asc')->get();

        return view('admin.product.edit', compact('product', 'brands', 'categories'));
    }

    // update
    public function update(Product $product, Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'SKU' => 'required|string|max:50|unique:products,SKU,' . $product->id,
            'quantity' => 'required|integer|min:0',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'required|boolean',
        ]);

        $imageName = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                @unlink(public_path('assets/upload/product/' . $product->image));
                @unlink(public_path('assets/upload/product/thumb/' . $product->image));
            }

            $imageName = $this->imageService->uploadWithThumbnail(
                $request->file('image'),
                'assets/upload/product',
                'assets/upload/product/thumb',
            );
        }

        $galleryImages = $product->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($galleryImages as $g) {
                @unlink(public_path('uploads/products/gallery/' . $g));
            }

            $galleryImages = [];
            foreach ($request->file('images') as $galleryImage) {
                $gName = time() . '_' . uniqid() . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('uploads/products/gallery'), $gName);
                $galleryImages[] = $gName;
            }
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'],
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'SKU' => $validated['SKU'],
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'image' => $imageName,
            'images' => $galleryImages,
            'price' => $validated['regular_price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'stock' => $validated['quantity'],
            'in_stock' => $validated['stock_status'] === 'instock',
            'featured' => $validated['featured'],
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    // destroy
    public function destroy(Product $product)
    {
        //
        $product->delete();
        if ($product->image && file_exists(public_path('assets/upload/product/' . $product->image))) {
            File::delete(public_path('assets/upload/product/' . $product->image));
        }
        if ($product->image && file_exists(public_path('assets/upload/product/thumb/' . $product->image))) {
            File::delete(public_path('assets/upload/product/thumb/' . $product->image));
        }

        if ($product->images) {
            foreach ($product->images as $image) {
                if (file_exists(public_path('uploads/products/gallery/' . $image))) {
                    File::delete(public_path('uploads/products/gallery/' . $image));
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
