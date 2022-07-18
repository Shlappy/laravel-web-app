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
        $cart = Cart::getContent();

        if ($cart->has($request->id)) {
            $this->updateCart($request);
        }

        $product = Product::findOrFail($request->id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'image' => $product->image,
            ]
        ]);

        return;
        // return redirect()->route('cart.list');
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

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return;
        // return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
