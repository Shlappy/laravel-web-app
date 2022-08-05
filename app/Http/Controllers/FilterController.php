<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filters\Filter;
// use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function __construct(protected Filter $filters)
    { }

    public function index(Category $category)
    {
        return response()->json($this->filters->getFiltersForCategory($category));
    }
}
