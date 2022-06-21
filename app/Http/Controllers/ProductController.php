<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    $filters = DB::table('filters', 'f')
      ->join('filter_specs as s', 'f.specs_id', '=', 's.id')
      ->where('f.category_id', '=', $category->id)
      ->select('f.value', 'f.code', 's.name', 's.type', 's.slug')
      ->get();

    return view('pages.products.index', compact('filters'));
    // return view('pages.products.index', compact('products'));
  }
}
