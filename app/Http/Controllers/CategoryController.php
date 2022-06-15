<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \app\Models\Category;
class CategoryController extends Controller
{
  public function adminIndex()
  {
    $parentCategories = Category::where('parent_id', 0)->get();

    return view('admin.product.categoryTreeView', compact('parentCategories'));
  }

  // public function index()
  // {
  //   $parentCategories = Category::where('parent_id', 0)->get();

  //   return view('admin.product.categoryTreeView', compact('parentCategories'));
  // }
}
