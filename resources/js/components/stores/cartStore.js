import axios from 'axios';
import { defineStore } from 'pinia';
import { computed, ref } from 'vue';

export const useCartStore = defineStore('cart', () => {
  /** @type { count: number, list: Object, symbol: string, total: string } */
  const data = ref({});

  const products = computed(() => data.list);

  const setData = (inputData) => {
    data.value = inputData;
  }

  const clearCart = () => {
    data.list = [];
  }

  const initialize = async () => {
    axios.get('/cart')
    .then(res => {setData(res.data); console.log(res)})
    .catch(err => console.error(err));
  }

  return { initialize, products, data, setData, clearCart };
})
