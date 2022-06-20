<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Filter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request, Category $category)
  {
    if ($request->ajax() || $request->isJson()) {
      $products = Product::whereBelongsTo($category)->paginate(12);

      return response()->json(
        view('components.product.product-list', compact('products'))->render()
      );
    }

    $filters = Filter::whereBelongsTo($category)->get();

    return view('pages.products.index', compact('filters'));
    // return view('pages.products.index', compact('products'));
  }
}
