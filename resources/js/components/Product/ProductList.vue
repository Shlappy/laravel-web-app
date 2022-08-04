<script setup>
import ProductItem from "@/components/Product/ProductItem.vue";
import Pagination from "@/components/Pagination.vue";

const props = defineProps({ products: Object }),
  emit = defineEmits(["newPage"]);

const changePage = (page) => {
  emit("newPage", page);
};
</script>

<template>
  <div class="product-card__list">
    <template v-for="product in products.list" :key="product.id">
      <ProductItem :product="product" />
    </template>
  </div>

  <Pagination :pagination="products.meta" @newPage="changePage" />
</template>
