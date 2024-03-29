<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Cart;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $inCart = Cart::has($this->id);
   
        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->whenLoaded('category'),
            'price' => format_price($this->price),
            'old_price' => format_price($this->old_price),
            'symbol' => __('app.money_symbol'),
            'images' => $this->images,
            'slug' => $this->slug,
            'inCart' => $this->when($inCart, true)
        ];

        return $resource;
    }
}
