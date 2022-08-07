<?php

namespace App\Models\Filters;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterOption extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'numeric_value',
        'string_value',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

    public function getFiltersForCategory(Category $category)
    {
        $filters = FilterOption::where('category_id', $category->id)->with('filter')->get();

        return (new \App\Services\Filter\FiltersService())->filterResponse($filters);
    }
}
