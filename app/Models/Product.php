<?php

namespace App\Models;

use App\Helper\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Filter;

class Product extends Model
{
  use HasFactory, Imageable;

  protected $fillable = [
    'name',
    'price',
    'old_price',
    'images',
    'stock',
    'is_popular',
    'category_id',
  ];

  // public function category()
  // {
  //   return $this->belongsTo(Category::class);
  // }

  public function filters()
  {
    return $this->hasMany(Filter::class);
  }
}
