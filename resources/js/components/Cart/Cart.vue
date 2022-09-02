<script setup>
import CartList from "./CartList.vue";
import { useCartStore } from "@/components/stores/cartStore.js";
import MainButton from "../UI/MainButton.vue";

const cart = useCartStore();

const props = defineProps({
  pageTitle: {
    type: String,
    default: "Корзина",
  },
});
</script>

<template>
  <div class="cart">
    <div class="container">
      <div class="flex-title">
        <h1 class="cart-title" v-text="pageTitle"></h1>
        <div class="cart-amount">
          <span v-text="cart.data.count"></span>
          <span> товаров</span>
        </div>
      </div>

      <div class="cart-content">
        <div class="cart-items">
          <CartList />
        </div>

        <div class="total-amount">
          <MainButton buttonType="primary">Оформить</MainButton>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.cart-title {
  margin-bottom: 0;
}

.flex-title {
  display: flex;
  align-items: center;
  margin-bottom: 35px;
}

.cart-content {
  display: flex;
  justify-content: space-between;
}

.cart-amount {
  margin-left: 10px;
  position: relative;
  top: 5px;
  color: #9b9b9b;
  font-size: 0.9rem;
}
</style>
