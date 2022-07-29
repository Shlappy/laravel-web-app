<x-general.button 
    class="button__buy product-card__buy" 
    ::data-action="buttonBuyAction"
    x-on:click="buttonBuyCallback()"
    x-text="buttonBuyText"
    x-bind:disabled="buttonBuyDisabled"
    >
</x-general.button>