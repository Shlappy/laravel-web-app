<script setup>
const props = defineProps({
  products: Object
});
</script>

<template>
  <div class="product-card__list">
    <template v-for="product in products.data" :key="product.id">
      <product-item :product="product"></product-item>
    </template>
  </div>

  <div>pagination</div>
</template>
