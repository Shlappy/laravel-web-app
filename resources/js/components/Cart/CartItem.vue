<script setup>
import MainButton from "@/components//UI/MainButton.vue";
import { useCartStore } from "@/components/stores/cartStore.js";
import Spinner from "@/components/UI/Spinner.vue";
import TrashCan from "../Assets/Icons/TrashCan.vue";

const cart = useCartStore();

const props = defineProps({ product: Object });

const removeItem = () => {
  cart.removeItem(props.product.id);
};

const addOne = (count) => {
  if (props.product.cart.quantity >= 99) return;
  cart.update(props.product.id, count);
};

const updateCart = (count) => {
  if (count >= 99) cart.update(props.product.id, 99);
  else if (count <= 1) cart.update(props.product.id, 1);
  else cart.update(props.product.id, count);
};

const removeOne = (count) => {
  if (props.product.cart.quantity <= 1) return;
  cart.update(props.product.id, count);
};
</script>

<template>
  <div class="cart-items__product">
    <div class="cart-items__content">

      <div class="cart-items__wrapper">
        <div class="cart-items__image">
          <img
            :src="'/storage/images/products/' + product.cart.attributes.image"
          />
        </div>

        <div class="cart-items__name" v-text="product.name"></div>

        <div class="cart-items__spinner">
          <Spinner
            :count="product.cart.quantity"
            :isDisabled="cart.ajaxProcessing"
            @inputChange="updateCart"
            @increment="addOne"
            @decrement="removeOne"
          />
        </div>

        <div class="cart-items__total-price">
          <span v-text="product.cart.totalPrice"></span>
          <span>&nbsp;₽</span>
        </div>

        <MainButton
          class="cart-items__delete"
          button-type="secondary"
          @click="removeItem"
        >
          <TrashCan />
        </MainButton>
      </div>
      
    </div>
  </div>
</template>
