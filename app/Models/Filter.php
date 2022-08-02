<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Filter extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFiltersForCategory(Category $category)
    {
        $rawFilter = DB::table('filters', 'f')
        ->join('filter_specs as s', 'f.specs_id', '=', 's.id')
        ->where('f.category_id', '=', $category->id)
        ->select('f.value', 'f.code', 's.name', 's.type', 's.slug')
        ->get();

        return (new \App\Services\Filter\FiltersService())->filterResponse($rawFilter);
    }
}
