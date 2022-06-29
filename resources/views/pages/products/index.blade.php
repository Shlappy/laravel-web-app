<x-app-layout>
  <div class="container container--lg">
    <div class="product__blocks">

      <x-products.filters id="filters" :filters="$filters" class="filter filter__products"></x-products.filters>

      <div class="product__catalog-wrapper" x-data x-html="$store.products.html">
      </div>

    </div>
  </div>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.store('products', {
        html: <?= str_replace(
          ['\u0022', '\u0027'], ["\\\"", "\\'"], 
          json_encode(view('components.product.product-list', compact('products'))->render())
        ) ?>,
        // filterElements: [],
 
        async get(url = window.location.href) {
          await axios.get(url).then(response => this.html = response.data);
          window.scrollTo({top: 0, behavior: 'smooth'});
        },

        // storeFilterElement(el) {
        //   this.filterElements.push(el);
        //   console.log(this.filterElements)
        // }
      });
    });
  </script>
</x-app-layout>