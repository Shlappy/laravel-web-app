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

  const clear = () => {
    axios.post('/cart-clear')
      .then(res => setData(res.data))
      .catch(err => console.error(err));
  }

  const removeItem = () => {

  }

  const fetchCart = async () => {
    axios.get('/cart')
      .then(res => setData(res.data))
      .catch(err => console.error(err));
  }

  return { fetchCart, products, data, setData, clear };
})
