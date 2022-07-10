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

  /**
   * Get products with the selected filters
   */
  public function getProducts(Request $request, Category $category)
  {
    $filters = $request->post()['filters'];

    if (!$filters) {
      $products = Product::whereBelongsTo($category)->paginate(12);

      if ($products->isEmpty()) return json_encode(['Товаров в данной категории нет']);

      return response()->json(
        view('components.product.product-list', compact('products'))->render()
      );
    }

    $specs = [];
    foreach ($filters as $filter) {
      $specs[] = $filter['name'];
    }

    $productsSubQuery = DB::table('filters', 'f')
      ->select('f.product_id')
      ->where('f.category_id', '=', $category->id)
      ->join('filter_specs as s', 'f.specs_id', '=', 's.id');

    $productsSubQuery->whereIn('s.slug', $specs)
      ->where(function ($mainQuery) use ($filters) {
        foreach ($filters as $key => $filter) {

          // Type "checkbox"
          if ($filter['type'] === 'checkbox') {
            $queryFn = fn ($query) => $query
              ->whereIn('f.code', $filter['values']);
          };

          // Type "between"
          if ($filter['type'] === 'between') {
            $min = $filter['values'][0];
            $max = $filter['values'][1];

            $queryFn = fn ($query) => $query
              ->whereBetween('f.code', [(int) $min, (int) $max]);
          };

          if ($key) {
            $mainQuery->orWhere($queryFn);
          } else {
            $mainQuery->where($queryFn);
          }
        }
      })
      ->groupBy('f.product_id', 'f.specs_id');

      //SELECT CONCAT (col1, '_', col2) AS Group1 ... GROUP BY Group1 //try this

    $productIds = $productsSubQuery->get();
    $ids = [];
    foreach ($productIds as $id) {
      $ids[] = $id->product_id;
    }

    $products = Product::select('name', 'price', 'old_price', 'images')
      ->whereIn('id', $ids)->paginate(12);

    if ($products->isEmpty()) return json_encode(['Товары с такими фильтрами не найдены']);

    return response()->json(
      view('components.product.product-list', compact('products'))->render()
    );
  }
}
