<script setup>
import { reactive } from "vue";
import MainButton from "@/components/UI/MainButton.vue";
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();

const props = defineProps({
  product: Object,
});

const buyButton = reactive({
  text: "Купить",
});

const cartLinks = {
  add: '/cart',
  update: '/update-cart',
  remove: '/cart-remove',
  clear: '/cart-clear'
};

const addToCart = () => {
  cartAjax('/cart');
}

const removeFromCart = () => {
  cartAjax('/cart-remove');
}

const cartAjax = (url) => {
  axios.post(url, { id: props.product.id })
    .then((res) => cart.setData(res.data))
    .catch((err) => console.error(err));
}
</script>

<template>
  <div class="product-card">
    <div class="product-card__elements">
      <MainButton @click="addToCart" class="button__buy" :button-type="'primary'">{{
        buyButton.text
      }}</MainButton>
      <MainButton class="button__bg button__bg--copy" :button-type="'round'" />
      <MainButton class="button__bg button__bg--heart" :button-type="'round'" />
    </div>
    <a :href="'/product/' + product.slug">
      <div class="product-card__upper"></div>
      <div class="product-card__bottom">
        <div class="product-card__name">{{ product.name }}</div>
        <div class="product-card__price">
          <span>{{ product.price }}</span>
          <span>₽</span>
        </div>
      </div>
    </a>
  </div>
</template>
