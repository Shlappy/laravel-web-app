<?php

namespace App\Models\Filters;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type',
    ];

    public function filterOptions()
    {
        return $this->hasMany(FilterOption::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getFiltersForCategory(Category $category)
    {
        $filters = $category->filters()->with([
            'filterOptions' => function ($query) use ($category) {
                $query->select('filter_options.*')
                ->join('filter_option_product as fop', 'fop.filter_option_id', '=', 'filter_options.id')
                ->join('products as p', 'p.id', '=', 'fop.product_id')
                ->groupBy('string_value', 'numeric_value')
                ->orderBy('numeric_value')
                ->where('p.category_id', $category->id);
            }
        ])->get();

        return response()->json($filters);
    }
}
