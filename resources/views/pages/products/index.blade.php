<x-app-layout>
  <div class="container container--lg">
    <div class="product__blocks">

      <x-products.filters x-init="$store.products.storeFilterElements()" id="filters" :filters="$filters" class="filter filter__products"></x-products.filters>

      <div class="product__catalog-wrapper" x-data x-html="$store.products.html">
      </div>

    </div>
  </div>
  <script>
    const optionChange = new Event('optionChange', {
      bubbles: true
    });

    document.addEventListener('alpine:init', () => {
      Alpine.store('products', {
        html: <?= str_replace(
                ['\u0022', '\u0027'],
                ["\\\"", "\\'"],
                json_encode(view('components.product.product-list', compact('products'))->render())
              ) ?>,
        filterElements: [],
        affectedFilters: [],

        async get(url = window.location.href) {
          await axios.get(url).then(response => this.html = response.data);
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
          });
        },

        storeFilterElements(el) {
          this.filterElements = document.querySelectorAll('#filters .filter-item');
          let checkboxes = document.querySelectorAll('#filters .filter-item .form-input__checkbox input');

          this.filterElements.forEach(filterEl => {
            filterEl.addEventListener('optionChange', function(e) {
              console.log(`event triggered by: ${e}`)
              this.affectedFilters.push(filterEl)
              // if (!this.affectedFilters.includes(filterEl)) {this.affectedFilters.push(filterEl); console.log(filterEl);} else {console.log('in there')};
            })
          })

          checkboxes.forEach(el => {
            el.addEventListener('change', e => e.target.dispatchEvent(optionChange))
          });
        }
      });
    });
  </script>
</x-app-layout>