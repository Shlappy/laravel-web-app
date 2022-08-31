import axios from 'axios';
import { defineStore } from 'pinia';
import { computed, ref } from 'vue';

export const useCartStore = defineStore('cart', () => {
  /** @type { count: number, list: Object, symbol: string, total: string } */
  const cartStoreData = ref({});

  /**
   * Getter for cartStoreData
   */
  const data = computed(() => {
    return cartStoreData.value;
  })

  const products = computed(() => cartStoreData.list);

  const setData = (inputData) => {
    cartStoreData.value = inputData;
  }

  const clear = () => {
    axios.post('/cart-clear')
      .then(res => setData(res.data))
      .catch(err => console.error(err));
  }

  const removeItem = (id) => {
    axios.post('/cart-remove', { id })
      .then(res => setData(res.data))
      .catch(err => console.error(err));
  }

  const fetchCart = async () => {
    axios.get('/cart-list')
      .then(res => setData(res.data))
      .catch(err => console.error(err));
  }

  return { removeItem, fetchCart, products, data, setData, clear };
})
