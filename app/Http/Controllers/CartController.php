<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product\CartSessionCollection;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Cart\CartSession;
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

    public function index(Request $request)
    {
        $cartItems = Cart::getContent();

        return view('pages.cart.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        if (Cart::has($request->id)) return $this->update($request);

        CartSession::addFromRequest($request);

        session()->flash('success', __('cart.added'));

        return $this->cartResponse();
    }

    public function list()
    {
        return $this->cartResponse();
    }

    public function update(Request $request)
    {
        CartSession::updateFromRequest($request);

        session()->flash('success', __('cart.added'));

        return $this->cartResponse();
    }

    public function remove(Request $request)
    {
        Cart::remove($request->id);

        session()->flash('success', __('cart.removed'));

        return $this->cartResponse();
    }

    public function clear()
    {
        Cart::clear();

        session()->flash('success', __('cart.cleared'));

        return $this->cartResponse();
    }

    /**
     * Response for an AJAX call
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    protected function cartResponse()
    {
        return response()->json([
            'count' => Cart::getTotalQuantity(),
            'total' => format_price(Cart::getTotal()),
            'symbol' => __('app.money_symbol'),
            'list' => new CartSessionCollection(Cart::getContent()->sortBy('name')),
        ]);
    }
}
