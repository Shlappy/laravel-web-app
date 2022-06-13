<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \app\Models\Category;
class CategoryController extends Controller
{
  public function index()
  {
    $parentCategories = Category::where('parent_id', 0)->get();

    return view('admin.product.categoryTreeView', compact('parentCategories'));
  }
}
