<x-app-layout>
  <div class="container container--lg">
    <div class="product__blocks">
      
      <div class="filter filter__products">
        
      </div>

      <div 
        class="product__catalog-wrapper" 
        x-init="$store.products.get()" 
        x-html="$store.products.html"
        >
        <x-product.product-list :products="$products"></x-product.product-list>
      </div>

    </div>
  </div>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('products', {
        html: '',
 
        async get(url = window.location.href) {
          await fetch(url, {
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
              "X-Requested-With": "XMLHttpRequest",
              "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').content
            },
            method: "get",
            credentials: "same-origin"
          })
            .then(response => response.json())
            .then(data => this.html = data);

          window.scrollTo({top: 0, behavior: 'smooth'});
        }
      })
    })
  </script>
</x-app-layout>