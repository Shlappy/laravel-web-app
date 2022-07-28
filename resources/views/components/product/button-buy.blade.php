{{-- @aware(['product']) --}}

{{-- @php
    $inBasket = Cart::has($product->id);
    $buttonText = $inBasket ? 'Убрать' : 'В корзину';
    $buttonAction = $inBasket ? 'remove' : 'buy';
@endphp --}}

<x-general.button 
    class="button__buy product-card__buy" 
    data-action="buy"
    x-on:click="buttonBuyCallback()"
    x-init="buttonBuyAction = 'buy'; buttonBuyText = 'В корзину'"
    x-text="buttonBuyText"
    x-bind:disabled="buttonBuyDisabled"
    >
</x-general.button>