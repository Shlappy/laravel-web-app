<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Filters\FilterOption;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory, Sluggable, UsesUuid;

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'images',
        'stock',
        'is_popular',
        'category_id',
    ];

    /**
     * Convert price from integer to float
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => convert_price($value),
        );
    }

    /**
     * Convert images from json to an array
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function images(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
        );
    }

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
     * Apply filters
     * 
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param array $filters
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCanFilter($builder, $filters)
    {
        (new \App\Filters\ProductFilter($filters))->filter($builder);
    }
}
