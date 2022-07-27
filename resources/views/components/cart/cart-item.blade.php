<div class="cart-item">
    <div class="cart-item__image">
        <img :src="product.attributes.image">
    </div>

    <div x-text="product.name" class="cart-item__name"></div>

    <div class="cart-item__price">
        <span x-text="product.price"></span>
        <span>₽</span>
    </div>

    <div class="cart-item__delete">X</div>
</div>