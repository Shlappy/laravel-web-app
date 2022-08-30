<script setup>
import CartList from "@/components/Product/CartList.vue";
import MainButton from "../UI/MainButton.vue";
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();
</script>

<template>
  <div class="cart-modal" id="cart-modal">
    <div class="cart-modal__body">
      <div class="cart-modal__row cart-modal__header">
        <div class="cart-modal__header-title">
          <span>Товары: &nbsp;</span>
          <span v-text="cart.data.count"></span>
        </div>
        <MainButton v-if="cart.data.count" class="cart-modal__clear" @click="cart.clear">Очистить корзину</MainButton>
      </div>
      <div class="cart-modal__middle">
        <CartList></CartList>
      </div>
      <div class="cart-modal__bottom"></div>
    </div>
  </div>
</template>
