<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
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
     * todo: return new FilterResource
     */
    public function index(Category $category)
    {
        return response()->json($this->filters->getFiltersForCategory($category));
    }
}
