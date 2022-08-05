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

    public function getFiltersForCategory(Category $category)
    {
        $filters = Filter::with('filterOptions')->get();

        return response()->json($filters);
    }
}
