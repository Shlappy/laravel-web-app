<script setup>
import CartItem from "@/components/Product/CartItem.vue";
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();
</script>

<template>
  <div class="cart__list" v-for="product in cart.data.list" :key="product.id">
    <CartItem :product="product"></CartItem>
  </div>
</template>
