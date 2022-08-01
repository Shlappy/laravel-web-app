import { defineStore } from 'pinia';
import { computed, reactive } from 'vue';

export const useCartStore = defineStore('cart', () => {
  const data = reactive({
    count: 0,
    total: '',
    list: []
  });

  const products = computed(() => data.list);

  const setData = (inputData) => {
    data.count = inputData.count;
    data.total = inputData.total;
    data.list = inputData.list;
  }

  const clearProducts = () => {
    data.list = [];
  }

  return { products, data, setData, clearProducts };
})
