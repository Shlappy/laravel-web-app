<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Filters\Filter;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function __construct(protected Filter $filters)
    { }

    public function index(Category $category)
    {
        return response()->json($this->filters->getFiltersForCategory($category));
    }
}
