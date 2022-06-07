<?php

namespace App\Http\Controllers\CMS\ManageProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'cms/manage-products/categories';
    }

    public function index()
    {
        $categories = Category::leftjoin('categories as parent_cat', 'parent_cat.id', 'categories.parent_id')
            ->oldest('categories.sort')
            ->get(['categories.*', 'parent_cat.name as parent_category']);

        return view($this->baseView . '/index', compact('categories'));
    }

    public function create()
    {
        $parentCategories = Category::whereParentId(0)->get();
        return view($this->baseView . '/create', compact('parentCategories'));
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->parent_id = $request->parent_id?? 0;
        $category->name = $request->name;
        $category->sort = $request->sort;
        $category->save();

        return back()->with('success', 'New category has been added.');
    }

    public function edit($id)
    {
        $parentCategories = Category::whereParentId(0)->get();
        $category = Category::findOrFail($id);

        return view($this->baseView . '/edit', compact('parentCategories', 'category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->parent_id = $request->parent_id?? 0;
        $category->name = $request->name;
        $category->sort = $request->sort;
        $category->save();

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
