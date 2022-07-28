<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();

        return view('pages.cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        if (Cart::has($request->id)) return $this->update($request);

        Cart::addFromRequest($request);

        session()->flash('success', __('cart.added'));

        return $this->ajaxCartResponse();
    }

    public function update(Request $request)
    {
        Cart::updateFromRequest($request);

        session()->flash('success', __('cart.added'));

        return $this->ajaxCartResponse();
    }

    public function remove(Request $request)
    {
        Cart::remove($request->id);

        session()->flash('success', __('cart.removed'));

        return $this->ajaxCartResponse();
    }

    public function clear()
    {
        Cart::clear();

        session()->flash('success', __('cart.cleared'));

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
