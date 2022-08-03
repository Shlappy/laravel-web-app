<script setup>
import ProductItem from "@/components/Product/ProductItem.vue";
import Pagination from "@/components/Pagination.vue";
import axios from "axios";
import { ref } from "vue";

const props = defineProps({
  products: Object,
});

const productList = ref(props.products);

const getProducts = (page) => {
  console.log(page);
  // axios.post()
  //   .then(res => console.log(res))
  //   .catch(err => console.error(err));
};
</script>

<template>
  <div class="product-card__list">
    <template v-for="product in productList.data" :key="product.id">
      <ProductItem :product="product" />
    </template>
  </div>

  <Pagination :paginationData="productList" @newPage="getProducts" />
</template>
