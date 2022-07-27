<header class="header" x-data="{ toggleMenu: false }">
  <x-layout.navbar></x-layout.navbar>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('cart', {
        count: @json(Cart::getTotalQuantity()),
        subTotal: @json(format_price(Cart::getTotal())),
        list: @json(Cart::getContentForOutput()),
      })
    })
  </script>
</header>