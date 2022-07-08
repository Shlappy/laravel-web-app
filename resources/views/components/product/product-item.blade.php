<div class="product-card">
  <div class="product-card__overhead">
    
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