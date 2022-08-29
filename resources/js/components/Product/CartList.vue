<script setup>
import CartItem from "@/components/Product/CartItem.vue";
import { ref } from "vue";
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();

const cartList = ref([]);

async function fetchCart() {
  axios.get('/cart')
    .then((res) => (cartList.value = res.data))
    .catch((err) => console.error(err));
}

fetchCart();
</script>

<template>
  <div class="cart__list" v-for="product in cart.data.list" :key="product.id">
    <CartItem :product="product"></CartItem>
  </div>
</template>
