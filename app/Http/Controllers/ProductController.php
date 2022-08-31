<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Product\ProductCollection;
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
        return view('pages.products.category-products', compact(['category']));
    }

    public function list(Category $category)
    {
        return new ProductCollection(Product::whereBelongsTo($category)->paginate(12));
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
        $products = Product::canFilter($request->filters)
            ->where('category_id', $category->id)
            ->paginate(12);

        return new ProductCollection($products);
    }
}
