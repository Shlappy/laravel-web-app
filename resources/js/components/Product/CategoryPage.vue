<script setup>
import ProductList from "@/components/Product/ProductList.vue";
import FilterList from "@/components/Filters/FilterList.vue";
import axios from "axios";
import { ref  } from "vue";
import { computed } from "@vue/reactivity";
import MainButton from "../UI/MainButton.vue";


const props = defineProps({
  category: Object,
});

const products = ref({}),
  // disabled = ref(false),
  pagination = computed(() => products.value.meta);

const getProducts = () => {
  ajaxCall(`/products/list/${props.category.slug}`);
};

const applyFilters = (data) => {
  if (data.length) ajaxCall(`/products/list/${props.category.slug}`, true, {'filters': data});
  else ajaxCall(`/products/list/${props.category.slug}`);
}

const changePage = async (page) => {
  // disabled.value = true;

  ajaxCall(`${products.value.meta.path}?page=${page}`).then(() => {
    scrollToTop();
    // disabled.value = false;
  });
};

async function ajaxCall(url, post = false, body = {}) {
  let res;

  if (post) res = axios.post(url, body);
  else res = axios.get(url);

  return res
    .then((res) => products.value = res.data)
    .catch((err) => console.error(err));
}

getProducts();
</script>

<template>
  <div class="container container--lg">
    <div class="product__blocks" :data-category="category.id">
      <div class="product__filters">
        <FilterList @filterApply="applyFilters" :category="category" class="filter__products" />
      </div>

      <div class="product__catalog-wrapper">
        <div class="filter__actions">
          <div class="filter__actions-tab">
            <span class="filter__actions-tab-title">Сортировать по:&nbsp;</span>
            <span>Цена (убыв.)</span>
          </div>  
          <div class="filter__actions-tab">
            <span class="filter__actions-tab-title">Показать:&nbsp;</span>
            <span>12</span>
          </div>  
          <div class="filter__actions-tab no-padding">
            <MainButton class="filter__square-button filter__view-type"></MainButton>
            <MainButton class="filter__square-button filter__view-type"></MainButton>
            <span class="filter__actions-tab-title">Сравнить:</span>
          </div>  
        </div>

        <ProductList :products="products" />

        <Pagination
          v-if="pagination && pagination.from !== pagination.last_page"
          :pagination="pagination"
          @newPage="changePage"
        />
      </div>
    </div>
  </div>
</template>
