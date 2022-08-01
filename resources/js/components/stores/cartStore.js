import axios from 'axios';
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

  const initialize = async () => {
    axios.get('/cart')
    .then(res => setData(res.data))
    .catch(err => console.error(err));
  }

  return { initialize, products, data, setData, clearProducts };
})
