<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();

        return view('pages.cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        if (Cart::has($request->id)) return $this->updateCart($request);

        $product = Product::findOrFail($request->id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
            ],
            'associatedModel' => 'Product'
        ]);

        return $this->ajaxCartResponse();
    }

    public function updateCart(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => 1
                ],
            ]
        );

        session()->flash('success', 'Товар успешно добавлен в корзину');

        return $this->ajaxCartResponse();
    }

    public function removeFromCart(Request $request)
    {
        Cart::remove($request->id);
        session()->flash('success', 'Товар успешно удалён из корзины');

        return $this->ajaxCartResponse();
    }

    public function clearAllCart()
    {
        Cart::clear();

        session()->flash('success', 'Корзина успешно очищена');

        return $this->ajaxCartResponse();
    }

    protected function ajaxCartResponse()
    {
        return response()->json([
            'count' => Cart::getTotalQuantity(),
            'subTotal' => format_price(Cart::getTotal()),
            'list' => Cart::getContentForOutput(),
        ]);
    }
}
