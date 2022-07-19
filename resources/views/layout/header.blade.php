<header x-data="{ toggleMenu: false }">
  <x-layout.navbar></x-layout.navbar>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('cart', {
        count: {{ Cart::getTotalQuantity() }},
      })
    })
  </script>
</header>