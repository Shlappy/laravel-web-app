<script setup>
import ProductItem from "@/components/Product/ProductItem.vue";
import { ref, watch } from "vue";
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();
const productRefs = ref({});

const setInCart = (id) => {
  productRefs.value[id]?.setInCart(false);
};

const props = defineProps({ products: Object }),
  emit = defineEmits(["newPage"]);

// Set to false "inCart" property from product list
watch(() => cart.data, (newCart, oldCart) => {
    if (!newCart.list || !oldCart.list) return;
    let newList = Object.keys(newCart.list);
    let oldList = Object.keys(oldCart.list);
    if (newList.length >= oldList.length) return;

    let removedProducts = oldList.filter((x) => !newList.includes(x));
    removedProducts.forEach((id) => {
      setInCart(id);
    })
  }
)
</script>

<template>
  <div class="product-card__list">
    <template v-for="product in products.list" :key="product.id">
      <ProductItem :ref="(el) => { productRefs[product.id] = el }" :product="product" />
    </template>
  </div>
</template>
