<script setup>
import ProductItem from "@/components/Product/ProductItem.vue";

const props = defineProps({
  products: Object
});
</script>

<template>
  <div class="product-card__list">
    <template v-for="product in products.data" :key="product.id">
      <ProductItem :product="product" />
    </template>
  </div>

  <div>pagination</div>
</template>
