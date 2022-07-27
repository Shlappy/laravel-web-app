export default (root = null) => ({
  id: root.dataset.id,
  buttonBuyAction: '',
  buttonBuyText: '',
  buttonBuyDisabled: false,

  // Add, update or remove product
  buttonBuyCallback() {
    if (this.buttonBuyAction === 'buy') this.addToCart();
    if (this.buttonBuyAction === 'remove') this.removeFromCart();
  },

  // Add product to cart or update
  addToCart() {
    this.cartAjax('/cart')
      .then((res) => {
        this.buttonBuyAction = 'remove';
        this.buttonBuyText = 'Убрать';
      })
  },

  // Remove product from cart
  removeFromCart() {
    this.cartAjax('/cart-remove')
      .then((res) => {
        this.buttonBuyAction = 'buy';
        this.buttonBuyText = 'В корзину';
      })
  },

  async cartAjax(url) {
    this.buttonBuyDisabled = true;
    return await axios.post(url, { id: this.id })
      .then((res) => {
        Alpine.store('cart').count = res.data.count;
        Alpine.store('cart').subTotal = res.data.subTotal;
        Alpine.store('cart').list = res.data.list;
      })
      .catch((err) => console.error(err))
      .finally(() => {
        this.buttonBuyDisabled = false;
      })
  }
})