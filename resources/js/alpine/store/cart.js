import Alpine from 'alpinejs'

Alpine.store('cart', {
  count: app.cartCount,
  subTotal: app.cartSubTotal,
  list: app.cartList,
})