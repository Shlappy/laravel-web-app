<script setup>
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();

defineProps({
  link: {
    type: String,
    default: '/cart'
  }
});
</script>

<template>
  <div class="cart__link">
    <a :href="link">
      <span class="cart__icon" :data-count="cart.data.count"></span>
      <div class="cart__header-total">
        <span class="cart__header-price">{{ cart.data.total }} {{ cart.data.symbol }}</span>
      </div>
    </a>
  </div>
</template>
