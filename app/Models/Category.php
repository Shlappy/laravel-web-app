<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory, Sluggable;

  public $timestamps = false;

  public function sluggable(): array
  {
    return [
      'slug' => [
        'source' => 'name'
      ]
    ];
  }

  public function subcategory() 
  {
    return $this->hasMany(Category::class, 'parent_id');
  }

  // public function filters() 
  // {
  //   return $this->hasMany(Filter::class);
  // }

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
