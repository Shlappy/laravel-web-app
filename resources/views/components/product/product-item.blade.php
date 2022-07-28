<div class="product-card" :data-id="productItem.id" x-data="product($el)">
    <div class="product-card__elements">
        <x-product.button-buy></x-product.button-buy>
        <x-general.button class="button__bg button__bg--copy" type="round" div="true"></x-general.button>
        <x-general.button class="button__bg button__bg--heart" type="round" div="true"></x-general.button>
    </div>
    <a href="#">
        <div class="product-card__upper">
            <div class="product-card__image">
            </div>
        </div>
        <div class="product-card__bottom">
            <div class="product-card__name" x-text="productItem.name"></div>
            <div class="product-card__price">
                <span x-text="productItem.price"></span>
                <span>₽</span>
            </div>
        </div>
    </a>
</div>