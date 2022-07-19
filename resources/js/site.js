document.addEventListener("DOMContentLoaded", function () {

  // Add product to cart
  let buyButton = document.querySelectorAll('[data-action="buy"]');

  if (!buyButton.length) return;

  buyButton.forEach(e => {
    e.addEventListener('click', async function () {
      id = e.closest('.product-card[data-id]').dataset.id;

      try {
        await axios.post('/cart', { id })
          .then(res => {
            // Alpine.store('products').headerCart = res.data.html;
            Alpine.store('cart').count = res.data.count;
          })
      } catch (error) {
        console.error(error);
      }
    })
  });
});