<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Cart;

class CartSessionResource extends JsonResource
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = Product::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $inCart = Cart::has($this->id);
        $cartResource = [];

        if ($inCart) {
            $cart = Cart::get($this->id);
            $cartResource = array_merge($cart->toArray(), ['totalPrice' => format_price($cart->quantity * $cart->price)]);
        }

        $resource = [
            'id' => $this->id,
            'name' => $this->name,
            'price' => format_price($this->price),
            'old_price' => format_price($this->old_price),
            'symbol' => __('app.money_symbol'),
            'images' => $this->images,
            'slug' => $this->slug,
            'cart' => $this->when($inCart, $cartResource),
            'inCart' => $this->when($inCart, true)
        ];

        return $resource;
    }
}
