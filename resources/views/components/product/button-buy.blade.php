@aware(['product'])

@php
    $inBasket = Cart::has($product->id);
    $buttonText = $inBasket ? 'Убрать' : 'В корзину';
    $buttonAction = $inBasket ? 'remove' : 'buy';
@endphp

<x-general.button 
    class="button__buy product-card__buy" 
    data-action="{{ $buttonAction }}"
    x-on:click="buttonBuyCallback()"
    x-init="buttonBuyAction = '{{ $buttonAction }}'; buttonBuyText = '{{ $buttonText }}'"
    x-text="buttonBuyText"
    x-bind:disabled="buttonBuyDisabled"
    >
    {{ $buttonText }}
</x-general.button>