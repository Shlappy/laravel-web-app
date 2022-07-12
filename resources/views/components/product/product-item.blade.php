<div class="product-card" data-id="{{ $product->id }}">
    <div class="product-card__elements">
        <x-general.button class="button__buy product-card__buy" data-action="buy">В корзину</x-general.button>
        <x-general.button class="button__bg button__bg--copy" type="round" div="true"></x-general.button>
        <x-general.button class="button__bg button__bg--heart" type="round" div="true"></x-general.button>
    </div>
    <a href="{{ route('products.show', $product) }}">
        <div class="product-card__upper">
            @if(!is_null($product->images))
            <div class="product-card__image">
                <img src="{{ '/storage/images/products' . '/' . json_decode($product->images)[0] }}">
            </div>
            @endif
        </div>
        <div class="product-card__bottom">
            <div class="product-card__name">
                {{ $product->name }}
            </div>
            <div class="product-card__price">
                @price($product->price) <span>₽</span>
            </div>
            <!-- <div class="product-card__old-price">
        @price($product->old_price) <span>₽</span>
      </div> -->
        </div>
    </a>
</div>