<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
  public function index(Request $request, Category $category)
  {
    $products = Product::whereBelongsTo($category)->paginate(12);

    if ($request->ajax() || $request->isJson()) {
      return response()->json(
        view('components.product.product-list', compact('products'))->render()
      );
    }

    $filters = DB::table('filters', 'f')
      ->join('filter_specs as s', 'f.specs_id', '=', 's.id')
      ->where('f.category_id', '=', $category->id)
      ->select('f.value', 'f.code', 's.name', 's.type', 's.slug')
      ->get();

    // $data = DB::table('products', 'p')
    //   ->select('p.name')
    //   ->join('filters as f', 'p.id', '=', 'f.product_id')
    //   ->join('filter_specs as s', 'f.specs_id', '=', 's.id')
    //   ->where('p.category_id', '=', $category->id)
    //   ->where(function($query) {
    //     $query->where('s.name', 'Высота, мм')
    //           ->where('f.code', '2300');
    //   })
    //   ->orWhere(function($query) {
    //     $query->where('s.name', 'Глубина, мм')
    //           ->where('f.code', '542');
    //   })
    //   ->get();

    // dd($data);
    // return view('pages.index');

    return view('pages.products.index', compact(['filters', 'products']));
  }
}
