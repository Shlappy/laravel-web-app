<script setup>
import ProductItem from "@/components/Product/ProductItem.vue";

const props = defineProps({ products: Object }),
  emit = defineEmits(["newPage"]);
</script>

<template>
  <div class="product-card__list">
    <template v-for="product in products.list" :key="product.id">
      <ProductItem :product="product" />
    </template>
  </div>
</template>
