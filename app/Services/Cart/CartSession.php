<?php declare(strict_types=1);

namespace App\Services\Cart;

use Illuminate\Http\Request;
use Cart;

class CartSession
{
    /**
     * extract data from request and update cart
     */
    public static function updateFromRequest(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
    }

    /**
     * extract data from request and add to cart
     */
    public static function addFromRequest(Request $request)
    {
        $product = \App\Models\Product::findOrFail($request->id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->images[0],
                'category' => $product->category->name,
            ],
            'associatedModel' => 'Product'
        ]);
    }
}
