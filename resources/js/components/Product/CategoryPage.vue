<script setup>
import ProductList from "@/components/Product/ProductList.vue";
import FilterList from "@/components/Filters/FilterList.vue";
import axios from "axios";
import { ref, watch  } from "vue";
import { computed } from "@vue/reactivity";
import { useCartStore } from "@/components/stores/cartStore.js";

const cart = useCartStore();

const props = defineProps({
  category: Object,
});

const products = ref({}),
  // disabled = ref(false),
  pagination = computed(() => products.value.meta);

const getProducts = () => {
  ajaxCall(`/products/${props.category.slug}`);
};

const applyFilters = (data) => {
  if (data.length) ajaxCall(`/products/${props.category.slug}`, true, {'filters': data});
  else ajaxCall(`/products/${props.category.slug}`);
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

// Remove inCart property from product list
watch(() => cart.data, (newCart, oldCart) => {
    if (!newCart.list || !oldCart.list) return;

    let newList = Object.keys(newCart.list);
    let oldList = Object.keys(oldCart.list);

    if (newList.length >= oldList.length) return;

    let difference = oldList.filter((x) => !newList.includes(x));

    products.value.list.forEach((product) => {
      if (difference.includes(product.id)) {
        product.inCart = false;
      }
    });

    // может через $refs?
  }
)

getProducts();
</script>

<template>
  <div class="container container--lg">
    <div class="product__blocks" :data-category="category.id">
      <FilterList @filterApply="applyFilters" :category="category" class="filter__products" />

      <div class="product__catalog-wrapper">
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
