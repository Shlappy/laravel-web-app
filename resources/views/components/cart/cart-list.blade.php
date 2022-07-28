<div class="cart__list" x-data="{ products: $store.cart.list }" x-modelable="$store.cart.list" x-model="products">
    <template x-for="cartItem in products" :key="cartItem.id">
        <x-cart.cart-item></x-cart.cart-item>
    </template>
</div>
