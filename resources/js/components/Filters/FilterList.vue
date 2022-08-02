<script setup>
import FilterItem from "@/components/Filters/FilterItem.vue";
import axios from "axios";
import { onBeforeMount, ref } from "vue";

const props = defineProps({
  filtersType: {
    type: String,
    default: 'products'
  },
  category: {
    type: Object,
    required: false
  },
})

const filters = ref([]);

const getFilters = async () => {
  const tempUrl = `/api/filters/${props.category.id}`;

  axios.get(tempUrl).then((res) => {
    console.log(res);
    filters.value = res.data;
  }).catch(err => console.error(err));
}

onBeforeMount(() => {
  getFilters();
})
</script>

<template>
  <div id="filters" class="filter">
    <FilterItem v-for="filter in filters" :key="filter.slug" :filter="filter" />

    <div class="filter__buttons">
      <button type="primary">Применить</button>
      <button type="secondary">Сбросить</button>
    </div>
  </div>
</template>