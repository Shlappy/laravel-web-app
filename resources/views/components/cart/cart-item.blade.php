<div class="cart-item">
    <div class="cart-item__image">
        <img :src="cartItem.attributes.image">
    </div>

    <div x-text="cartItem.name" class="cart-item__name"></div>

    <div class="cart-item__price">
        <span x-text="cartItem.price"></span>
        <span>₽</span>
    </div>

    <div class="cart-item__delete">X</div>
</div>