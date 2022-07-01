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

    return view('pages.products.index', compact(['filters', 'products']));
  }

  public function getProducts(Request $request, Category $category)
  {
    $productsQuery = DB::table('products', 'p')
      ->distinct('p.name')
      ->select('p.name', 'p.price', 'p.old_price', 'p.images')
      ->join('filters as f', 'p.id', '=', 'f.product_id')
      ->join('filter_specs as s', 'f.specs_id', '=', 's.id')
      ->where('p.category_id', '=', $category->id);

    // // temp
    // $filters = [
    //   [
    //     'type' => 'checkbox',
    //     'name' => 'brend',
    //     'values' => [
    //       'flex'
    //     ]
    //   ],
    //   [
    //     'type' => 'checkbox',
    //     'name' => 'proizvoditel',
    //     'values' => [
    //       'longex'
    //     ]
    //   ],
    // ];

    $productsQuery->where(function ($mainQuery) use ($request) {
      if (isset($request->post()['filters']) && !empty($request->post()['filters'])) {
        foreach ($request->post()['filters'] as $key => $filter) {

          if ($filter['type'] === 'checkbox') {
            $queryFunc = fn ($query) => $query->where('s.slug', $filter['name'])
              ->whereIn('f.code', $filter['values']);

            if ($key === 0) {
              $mainQuery->where($queryFunc);
            } else {
              $mainQuery->orWhere($queryFunc);
            }
          };
        }
      }
    });

    $products = $productsQuery->paginate(12);

    if ($products->isEmpty()) return json_encode(['Товары с такими фильтрами не найдены']);

    return response()->json(
      view('components.product.product-list', compact('products'))->render()
    );
  }
}
