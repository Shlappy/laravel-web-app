<x-app-layout>
  <div class="container container--lg">
    <div class="product__blocks">
      
      <x-products.filters :filters="$filters" class="filter filter__products"></x-products.filters>

      <div 
        class="product__catalog-wrapper" 
        x-init="$store.products.get()" 
        x-html="$store.products.html"
        >
      </div>

    </div>
  </div>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('products', {
        html: '',
 
        async get(url = window.location.href) {
          await axios.get(url).then(response => this.html = response.data);

          window.scrollTo({top: 0, behavior: 'smooth'});
        },
      });
    })
  </script>
</x-app-layout>