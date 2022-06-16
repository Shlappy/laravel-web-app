<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use App\Models\Filter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    $products = Product::orderBy('id', 'DESC')->paginate(12);
    // dd($products);

    if ($request->ajax() || $request->isJson()) {
      return response()->json(
        view('components.product.product-list', compact('products'))->render()
      );
    }

    return view('pages.products.index', compact('products'));
  }
}
