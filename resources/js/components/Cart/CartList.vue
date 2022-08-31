<script setup>
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();

defineProps({
  itemComponent: {
    type: String,
    default: "CartItem",
  },
});

const cartItemComponents = {
  CartItem: 'CartItem',
  ModalCartItem: 'ModalCartItem',
};
</script>

<template>
  <component
    :is="cartItemComponents[itemComponent]"
    :product="product"
    v-for="product in cart.data.list"
    :key="product.id"
  />
</template>
