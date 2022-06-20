<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
  // public function adminIndex()
  // {
  //   $parentCategories = Category::where('parent_id', 0)->get();

  //   return view('admin.product.categoryTreeView', compact('parentCategories'));
  // }

  public function index()
  {
    return view('pages.categories.index');
  }

  public function show(Request $request, Category $category)
  {
    // dd($category->products->all());
    return view('pages.categories.index');
  }
}
