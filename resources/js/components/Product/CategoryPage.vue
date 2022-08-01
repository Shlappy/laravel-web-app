<script setup>
import ProductList from '@/components/Product/ProductList.vue';
import FilterList from '@/components/Filters/FilterList.vue';

defineProps({
  products: Object,
  category: Object
})
</script>

<template>
  <div class="container container--lg">
    <div class="product__blocks" :data-category="category.id">

      <FilterList :category="category" :filters-type="'products'" class="filter__products" />

      <div class="product__catalog-wrapper">
        <ProductList :products="products" />
      </div>

    </div>
  </div>
</template>
