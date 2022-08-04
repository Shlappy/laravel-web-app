<script setup>
import ProductList from "@/components/Product/ProductList.vue";
import FilterList from "@/components/Filters/FilterList.vue";
import axios from "axios";
import { ref } from "vue";

const props = defineProps({
  category: Object,
});

const products = ref({});

const getProducts = () => {
  ajaxCall(`/products/${props.category.slug}`);
};

const changePage = async (page) => {
  ajaxCall(`${products.value.meta.path}?page=${page}`);
};

function ajaxCall(url) {
  axios.get(url)
    .then((res) => (products.value = res.data))
    .catch((err) => console.error(err));
}

getProducts();
</script>

<template>
  <div class="container container--lg">
    <div class="product__blocks" :data-category="category.id">
      <FilterList :category="category" class="filter__products" />

      <div class="product__catalog-wrapper">
        <ProductList @newPage="changePage" :products="products" />
      </div>
    </div>
  </div>
</template>
