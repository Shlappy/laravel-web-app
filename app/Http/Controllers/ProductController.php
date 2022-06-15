<?php

namespace App\Http\Controllers;

use App\Models\Product;
// use App\Models\Filter;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    $products = Product::orderBy('id', 'DESC')->paginate(2);
    // dd($products);

    return view('pages.products.index', compact('products'));
  }
}
