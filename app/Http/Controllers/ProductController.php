<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * The filter instance.
     */
    protected $filters;

    public function __construct(Filter $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Category products page
     */
    public function index(Request $request, Category $category)
    {
        if ($request->ajax() || $request->isJson()) {
            return new ProductCollection(Product::whereBelongsTo($category)->paginate(12));
        }

        return view('pages.products.category-products', compact(['category']));
    }

    /**
     * Product page
     */
    public function show(Product $product)
    {
        return view('pages.products.index', compact(['product']));
    }

    // /**
    //  * PUT DB CODE INTO SERVICE OR MODEL CLASS
    //  * PUT DB CODE INTO SERVICE OR MODEL CLASS
    //  * PUT DB CODE INTO SERVICE OR MODEL CLASS
    //  * PUT DB CODE INTO SERVICE OR MODEL CLASS
    //  * Get products with the selected filters
    //  * 
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function getProducts(Request $request, Category $category)
    // {
    //     $filters = $request->filters;

    //     // Retrieve all products
    //     // todo: remove and return nothing in such case
    //     if (!$filters) {
    //         $products = Product::whereBelongsTo($category)->paginate(12);

    //         if ($products->isEmpty()) {
    //             return $this->productsResponse($products, 'no_products', __('product.empty'));
    //         }

    //         return $this->productsResponse($products, 'success');
    //     }

    //     $specs = [];
    //     foreach ($filters as $filter) {
    //         $specs[] = $filter['name'];
    //     }

    //     $productsSubQuery = DB::table('filters', 'f')
    //         ->select('p.id', 'p.name', 'p.price', 'p.images', 'p.old_price', 'p.slug')
    //         ->where('f.category_id', '=', $category->id)
    //         ->join('filter_specs as s', 'f.specs_id', '=', 's.id')
    //         ->join('products as p', 'f.product_id', '=', 'p.id');

    //     $productsSubQuery->whereIn('s.slug', $specs)
    //         ->where(function ($mainQuery) use ($filters) {
    //             foreach ($filters as $key => $filter) {

    //                 // Type "checkbox"
    //                 if ($filter['type'] === 'checkbox') {
    //                     $queryFn = fn ($query) => $query
    //                         ->whereIn('f.code', $filter['values']);
    //                 };

    //                 // Type "between"
    //                 if ($filter['type'] === 'between') {
    //                     $min = $filter['values'][0];
    //                     $max = $filter['values'][1];

    //                     $queryFn = fn ($query) => $query
    //                         ->whereBetween('f.code', [(int) $min, (int) $max]);
    //                 };

    //                 if ($key) {
    //                     $mainQuery->orWhere($queryFn);
    //                 } else {
    //                     $mainQuery->where($queryFn);
    //                 }
    //             }
    //         })
    //         ->groupBy('f.product_id', 'f.specs_id');

    //     $products = Product::select(DB::raw('*'), DB::raw('count(*) as count'))
    //         ->fromSub($productsSubQuery, 's')
    //         ->groupBy('id')
    //         ->having('count', '=', count($filters))
    //         ->paginate(12);

    //     if ($products->isEmpty()) {
    //         return $this->productsResponse(status: 'no_products', message: __('product.emptyFilters'));
    //     }

    //     return $this->productsResponse(products: $products, status: 'success');
    // }
}
