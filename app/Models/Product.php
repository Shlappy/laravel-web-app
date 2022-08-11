<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Filters\FilterOption;

class Product extends Model
{
    use HasFactory, Sluggable, \App\Traits\UsesUuid;

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'images',
        'stock',
        'is_popular',
        'category_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function filterOptions()
    {
        return $this->belongsToMany(FilterOption::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Applies filters
     * 
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param array $filters
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanFilter($builder, $filters)
    {
        (new \App\Filters\BaseFilter($filters))->filter($builder);
    }
}
