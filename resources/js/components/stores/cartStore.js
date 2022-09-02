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

  const ajaxProcessing = ref(false);

  const update = (id, quantity) => {
    ajaxCall('/update-cart', true, { id, quantity });
  }

  const clear = () => {
    ajaxCall('/cart-clear', true);
  }

  const removeItem = (id) => {
    ajaxCall('/cart-remove', true, { id });
  }

  const fetchCart = async () => {
    ajaxCall('/cart-list');
  }

  async function ajaxCall(url, post = false, body = {}) {
    let res;
    ajaxProcessing.value = true;

    if (post) res = axios.post(url, body);
    else res = axios.get(url);

    return res
      .then(res => setData(res.data))
      .catch(err => console.error(err))
      .finally(() => ajaxProcessing.value = false);
  }

  return { update, removeItem, fetchCart, products, data, setData, clear, ajaxProcessing };
})
