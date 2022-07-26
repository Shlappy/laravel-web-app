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
      .catch((err) => console.error(err))
  },

  // Remove product from cart
  removeFromCart() {
    this.cartAjax('/cart-remove')
      .then((res) => {
        this.buttonBuyAction = 'buy';
        this.buttonBuyText = 'В корзину';
      })
      .catch((err) => console.error(err))
  },

  async cartAjax(url) {
    this.buttonBuyDisabled = true;
    return await axios.post(url, { id: this.id })
      .then((res) => {
        // Alpine.store('products').headerCart = res.data.html;
        Alpine.store('cart').count = res.data.count;
        Alpine.store('cart').subTotal = res.data.subTotal;
      })
      .finally(() => {
        this.buttonBuyDisabled = false;
      })
  }
})