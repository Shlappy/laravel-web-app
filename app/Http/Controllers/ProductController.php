<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
use App\Http\Services\Filters\FilterService;
use App\Models\Category;
use App\Models\Filters\Filter;
use App\Models\Product;
use Illuminate\Http\Request;

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

    /**
     * Get products with the selected filters
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyFilters(Request $request, Category $category)
    { 
        // $products = (new FilterService())->applyFilters($request, $category);

        $filters = ['test'];
        $products = Product::canFilter($filters)->get();
        
        // return response()->json($products);
        return response()->json($request);
    }
}
