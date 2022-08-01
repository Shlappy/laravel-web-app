<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    /**
     * The product instance.
     */
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

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

    /**
     * Response for an AJAX call
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function ajaxCartResponse()
    {
        return response()->json([
            'count' => Cart::getTotalQuantity(),
            'total' => format_price(Cart::getTotal()),
            'list' => Cart::getContentForOutput(),
        ]);
    }
}
