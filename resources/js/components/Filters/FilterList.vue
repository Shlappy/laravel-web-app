<script setup>
import MainButton from "../UI/MainButton.vue";
import FilterItem from "@/components/Filters/FilterItem.vue";
import axios from "axios";
import { onBeforeMount, ref } from "vue";
import ResetIcon from "@/components/Assets/Icons/ResetIcon.vue";

const props = defineProps({
    category: {
      type: Object,
      required: false,
    },
  }),
  emit = defineEmits(["filterApply"]);

/**
 * Filters for the current catalog
 */
const filters = ref([]);

/**
 * Filter element refs
 */
const filterRefs = ref([]);

const getFilters = async () => {
  const tempUrl = `/api/filters/${props.category.id}`;

  axios.get(tempUrl)
    .then((res) => {
      filters.value = res.data.original;
    })
    .catch((err) => console.error(err));
};

const getProducts = () => {
  let filters = applyFilters();

  emit('filterApply', filters);
};

/**
 * Forms filter's data to send via ajax
 */
const applyFilters = () => {
  let outputData = [];

  filterRefs.value.forEach((filter) => {
    const filterData = filter.filterData;
    let data = {
      name: filterData.name,
      slug: filterData.slug,
      type: filterData.type,
    };

    if (data.type === "checkbox" && !(data.values = filter.checkedOptions()))
      return;
    if (data.type === "between" && !(data.values = filter.sliderOptions()))
      return;

    outputData.push(data);
  });

  return outputData;
};

const resetFilters = () => {
  filterRefs.value.forEach((filter) => {
    filter.reset();
  });

  getProducts();
};

onBeforeMount(() => {
  getFilters();
});
</script>

<template>
  <div id="filters" class="filter">
    <div class="filter__title-wrapper">
      <span class="filter__title">Фильтры</span>
        <MainButton @click="resetFilters" class="button__reset filter__reset filter__square-button">
          <ResetIcon />
        </MainButton>
    </div>
          
    <FilterItem
      v-for="filter in filters"
      :key="filter.id"
      :filterData="filter"
      ref="filterRefs"
    />

    <div class="filter__buttons">
      <MainButton button-type="primary" @click="getProducts">Применить</MainButton>
    </div>
  </div>
</template>
