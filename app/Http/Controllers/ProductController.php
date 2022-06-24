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

    // $data = DB::select('SELECT p.name FROM products as p 
    //             INNER JOIN filters as f ON p.id = f.product_id
    //             INNER JOIN filter_specs as s ON f.specs_id = s.id
    //             WHERE p.category_id = 4
    //             AND s.name = "Высота, мм" AND f.code = 2974
    //             OR s.name = "Ширина, мм" AND f.code = 2974
    //             ');

    // dd($data);
    // return view('pages.index');

    return view('pages.products./index', compact(['filters', 'products']));
  }
}
