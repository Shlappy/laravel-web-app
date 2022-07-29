<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;
use Common;
use JavaScript;
use Cart;

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
     * todo: put AJAX response into a separate function
     */
    public function index(Request $request, Category $category)
    {
        $products = Product::whereBelongsTo($category)->paginate(12);

        if ($request->ajax() || $request->isJson()) {
            return $this->productsResponse($products, Common::SUCCESS);
        }

        $filters = $this->filters->getFiltersForCategory($category);

        JavaScript::put([
            'products' => $this->productsInCart($products)->all(),
            'pagination' => $products->links()->render()
        ]);

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
     * PUT DB CODE INTO SERVICE CLASS
     * PUT DB CODE INTO SERVICE CLASS
     * PUT DB CODE INTO SERVICE CLASS
     * PUT DB CODE INTO SERVICE CLASS
     * Get products with the selected filters
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProducts(Request $request, Category $category)
    {
        $filters = $request->filters;

        // Retrieve all products
        // todo: remove and return nothing in such case
        if (!$filters) {
            $products = Product::whereBelongsTo($category)->paginate(12);

            if ($products->isEmpty()) {
                return $this->productsResponse($products, Common::NO_PRODUCTS, __('product.empty'));
            }
            
            return $this->productsResponse($products, Common::SUCCESS);
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

        if ($products->isEmpty()) {
            return $this->productsResponse(status: Common::NO_PRODUCTS, message: __('product.emptyFilters'));
        }

        return $this->productsResponse(products: $products, status: Common::SUCCESS);
    }

    /**
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES   
     * Response for an AJAX call
     * 
     * @param mixed $products Products to form a response from
     * @param mixed $status Response status
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function productsResponse($products = [], $status = '', $message = '')
    {
        $data = ['status' => $status];

        if ($products) {
            $data['products'] = $this->productsInCart($products)->all();
            $data['pagination'] = $products->links()->render();
        }

        if ($message) {
            $data['message'] = $message;
        }

        return response()->json($data);
    }

    /**
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES
     * REMAKE WITH RESOURCES   
     * Check whether product is in cart or not
     * 
     * @param \Illuminate\Support\Collection|\Illuminate\Pagination\LengthAwarePaginator $products
     * 
     * @return \Illuminate\Support\Collection
     */
    public function productsInCart($products)
    {
        return $products->transform(function($product, $index) {
            $product->inCart = Cart::has($product->id);
            return $product;
        });
    }
}
