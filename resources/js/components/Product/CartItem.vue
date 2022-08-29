<script setup>
import MainButton from '../UI/MainButton.vue';
// import { useCartStore } from "@/components/stores/cartStore.js";

// const cart = useCartStore();

const props = defineProps({
  product: Object,
});
</script>

<template>
  <div class="cart-item">
    <div class="cart-item__image"></div>

    <div class="cart-item__name" v-text="product.name"></div>

    <div class="cart-item__price">
      <span v-text="product.price"></span>
      <span>&nbsp;₽</span>
    </div>

    <MainButton 
      class="cart-item__delete" 
      button-type="secondary">
      X
    </MainButton>
  </div>
</template>
