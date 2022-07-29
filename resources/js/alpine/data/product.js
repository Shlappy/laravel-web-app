const removeFromCart = 'Убрать';
const addToCart = 'В корзину';
const addAction = 'buy';
const removeAction = 'remove';

export default (root = null, productItem = null) => ({
  root: root,
  buttonBuyAction: '',
  buttonBuyText: '',
  buttonBuyDisabled: false,
  inCart: productItem.inCart,

  init () {
    this.inCart ? this.buttonBuyAction = removeAction : this.buttonBuyAction = addAction;
    this.inCart ? this.buttonBuyText = removeFromCart : this.buttonBuyText = addToCart;
  },

  // Add, update or remove product
  buttonBuyCallback() {
    if (this.buttonBuyAction === addAction) this.addToCart();
    if (this.buttonBuyAction === removeAction) this.removeFromCart();
  },

  // Add product to cart or update
  addToCart() {
    this.cartAjax('/cart')
      .then((res) => {
        this.buttonBuyAction = removeAction;
        this.buttonBuyText = removeFromCart;
      })
  },

  // Remove product from cart
  removeFromCart() {
    this.cartAjax('/cart-remove')
      .then((res) => {
        this.buttonBuyAction = addAction;
        this.buttonBuyText = addToCart;
      })
  },

  async cartAjax(url) {
    this.buttonBuyDisabled = true;

    return await axios.post(url, { id: this.root.dataset.id })
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