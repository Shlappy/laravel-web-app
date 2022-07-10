<div class="product-card">
  <div class="product-card__elements">
    <x-general.button class="button__buy product-card__buy">В корзину</x-general.button>
    <x-general.button class="button__bg button__bg--copy" type="round" div="true"></x-general.button>
    <x-general.button class="button__bg button__bg--heart" type="round" div="true"></x-general.button>
  </div>
  <div class="product-card__upper">
    @if(!is_null($images))
      <div class="product-card__image">
        <img src="{{ '/storage/images/products' . '/' . $images[0] }}">
      </div>
    @endif
  </div>
  <div class="product-card__bottom">
    <div class="product-card__name">
      {{ $name }}
    </div>
    <div class="product-card__price">
      {{ $price }} <span>₽</span>
    </div>
    <!-- <div class="product-card__old-price">
    {{ $oldPrice }} <span>₽</span>
    </div> -->
  </div>
</div>