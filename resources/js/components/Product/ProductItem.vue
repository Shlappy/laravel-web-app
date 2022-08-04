<script setup>
import MainButton from "@/components/UI/MainButton.vue";
import { useCartStore } from "@/components/stores/cartStore.js";
import { ref, watch } from "vue";

const cart = useCartStore();

const props = defineProps({ product: Object });

const cartLinks = {
  add: "/cart",
  update: "/update-cart",
  remove: "/cart-remove",
};

const inCart = ref(props.product.inCart),
  disabled = ref(false);

watch(() => props.product, (product) => {
  inCart.value = product.inCart;
})

const addOrRemove = () => {
  disabled.value = true;
  inCart.value ? removeFromCart() : addToCart();
};

const addToCart = () => {
  cartAjax(cartLinks.add);
};

const removeFromCart = () => {
  cartAjax(cartLinks.remove);
};

const cartAjax = (url) => {
  axios.post(url, { id: props.product.id })
    .then((res) => {
      cart.setData(res.data);
      inCart.value = !inCart.value;
    })
    .catch((err) => console.error(err))
    .finally(() => {disabled.value = false});
};
</script>

<template>
  <div class="product-card">
    <div class="product-card__elements">
      <MainButton
        @click="addOrRemove"
        class="button__buy"
        :button-type="'primary'"
        :disabled="disabled"
        >{{ inCart ? "Убрать" : "В корзину" }}</MainButton
      >
      <MainButton class="button__bg button__bg--copy" :button-type="'round'" />
      <MainButton class="button__bg button__bg--heart" :button-type="'round'" />
    </div>
    <a :href="'/product/' + product.slug">
      <div class="product-card__upper"></div>
      <div class="product-card__bottom">
        <div class="product-card__name">{{ product.name }}</div>
        <div class="product-card__price">
          <span>{{ product.price }} {{ product.symbol }}</span>
        </div>
      </div>
    </a>
  </div>
</template>
