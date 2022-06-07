<?php

namespace App\Http\Controllers\CMS\ManageProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'cms/manage-products/products';
    }

    public function index()
    {
        $products = Product::all();
        return view($this->baseView . '/index', compact('products'));
    }

    public function create()
    {
        return view($this->baseView . '/create');
    }

    public function store(ProductRequest $request)
    {
        $finalThumbnail = '';
        if ($request->hasFile('thumbnail')) {
            $finalThumbnail = $this->fileUploadHandler($request->thumbnail, 'uploads/products/');
        }

        $product = new Product;
        $product->title = $request->title;
        $product->thumbnail = $finalThumbnail;
        $product->excerpt = $request->excerpt;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->sort = $request->sort;
        $product->save();

        return back()->with('success', 'New product has been added.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view($this->baseView . '/edit', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $finalThumbnail = $product->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if (!empty($product->thumbnail) && file_exists(public_path('uploads/products/' . $product->thumbnail))) {
                unlink(public_path('uploads/products/' . $product->thumbnail));
            }
            $finalThumbnail = $this->fileUploadHandler($request->thumbnail, 'uploads/products/');
        }

        $product->title = $request->title;
        $product->thumbnail = $finalThumbnail;
        $product->excerpt = $request->excerpt;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->sort = $request->sort;
        $product->save();

        return back()->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if (!empty($product->thumbnail) && file_exists(public_path('uploads/products/' . $product->thumbnail))) {
            unlink(public_path('uploads/products/' . $product->thumbnail));
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
