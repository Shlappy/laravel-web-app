<script setup>
import MainButton from "@/components/UI/MainButton.vue";
import { useCartStore } from "@/components/stores/cartStore.js";
import { onMounted, ref } from "vue";

const cart = useCartStore();

const props = defineProps({ product: Object });

const cartLinks = {
  add: "/cart",
  update: "/update-cart",
  remove: "/cart-remove",
};

const inCart = ref(props.product.inCart),
  disabled = ref(false);

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
    .finally(() => disabled.value = false);
};

const setInCart = (status = false) => {
  inCart.value = status;
}

defineExpose({ setInCart });
</script>

<template>
  <div class="product-card">
    
    <div class="product-card__popup">
      <div class="product-card__popup-upper">
        <span class="product-card__popup-upper-category" v-text="product.category.name"></span>
      </div>

      <div class="product-card__elements">
        <MainButton
          @click="addOrRemove"
          class="button__buy button--white"
          :class="{ disabled: disabled }"
          :button-type="'secondary'"
          :disabled="disabled"
          >{{ inCart ? "Убрать" : "В корзину" }}</MainButton
        >
        <MainButton class="button__bg button__bg--copy" :button-type="'round'" />
        <MainButton class="button__bg button__bg--heart" :button-type="'round'" />
      </div>
    </div>

    <a :href="'/product/' + product.slug">
      <div class="product-card__upper">
        <div class="product-card__image">
          <img :src="'/storage/images/products/' + product.images[0]">
        </div>
      </div>
      <div class="product-card__bottom">
        <div class="product-card__name">{{ product.name }}</div>
        <div class="product-card__price">
          <span>{{ product.price }}&nbsp;{{ product.symbol }}</span>
        </div>
      </div>
    </a>

  </div>
</template>
