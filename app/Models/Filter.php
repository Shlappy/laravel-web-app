<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Filter extends Model
{
  use HasFactory;

  public $timestamps = false;

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
