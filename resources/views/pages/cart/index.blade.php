<x-app-layout>
    <div class="cart">
        <div class="container">
            <h1>{{ __('cart.basket') }}</h1>

            <div class="cart-items">
                <cart-list></cart-list>
            </div>
        </div>
    </div>
</x-app-layout>