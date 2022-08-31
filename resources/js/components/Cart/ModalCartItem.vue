<script setup>
import MainButton from "../UI/MainButton.vue";
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();

const props = defineProps({ product: Object });

const removeItem = () => {
  cart.removeItem(props.product.id);
};
</script>

<template>
  <div class="cart-product">
    <div class="cart-product__image"></div>

    <div class="cart-product__name" v-text="product.name"></div>

    <div class="cart-product__price">
      <span v-text="product.price"></span>
      <span>&nbsp;₽</span>
    </div>

    <MainButton
      class="cart-product__delete"
      button-type="secondary"
      @click="removeItem"
    >
      X
    </MainButton>
  </div>
</template>
