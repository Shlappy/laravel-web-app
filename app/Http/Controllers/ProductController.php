<?php

namespace App\Http\Controllers;

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
     * 
     * todo: put AJAX response into separate function
     */
    public function index(Request $request, Category $category)
    {
        $products = Product::whereBelongsTo($category)->paginate(12);

        if ($request->ajax() || $request->isJson()) {
            return response()->json(['products' => $products]);
        }

        $filters = $this->filters->getFiltersForCategory($category);

        return view('pages.products.category-products', compact(['filters', 'products']));
    }

    /**
     * Product page
     */
    public function show(Product $product)
    {
        return view('pages.products.index', compact(['product']));
    }

    /**
     * Get products with the selected filters
     */
    public function getProducts(Request $request, Category $category)
    {
        $filters = $request->filters;

        // Retrieve all products
        // todo: remove and return nothing in such case
        if (!$filters) {
            $products = Product::whereBelongsTo($category)->paginate(12);

            if ($products->isEmpty()) return json_encode(['Товаров в данной категории нет']);

            return response()->json(['products' => $products]);
        }

        $specs = [];
        foreach ($filters as $filter) {
            $specs[] = $filter['name'];
        }

        $productsSubQuery = DB::table('filters', 'f')
            ->select('p.id', 'p.name', 'p.price', 'p.images', 'p.old_price', 'p.slug')
            ->where('f.category_id', '=', $category->id)
            ->join('filter_specs as s', 'f.specs_id', '=', 's.id')
            ->join('products as p', 'f.product_id', '=', 'p.id');

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

        $products = Product::select(DB::raw('*'), DB::raw('count(*) as count'))
            ->fromSub($productsSubQuery, 's')
            ->groupBy('id')
            ->having('count', '=', count($filters))
            ->paginate(12);

        if ($products->isEmpty()) return json_encode(['Товары с такими фильтрами не найдены']);

        return response()->json(['products' => $products]);
    }
}
