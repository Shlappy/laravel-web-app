<x-app-layout>
  <div class="container container--lg">
    <div class="product__blocks">

      <x-products.filters x-init="$store.products.storeFilterElement()" id="filters" :filters="$filters" class="filter filter__products"></x-products.filters>

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
          var filters = [];

          if (this.affectedFilters.length) filters = this.applyFilters();

          try {
            await axios.post(url, {
                filters
              })
              .then(response => {this.html = response.data});

            this.scrollToTop();
          } catch (error) {
            console.error(error);
          }
        },

        async getAll(url = window.location.href) {
          try {
            await axios.get(url)
              .then(response => this.html = response.data);

            this.resetFilters();
            this.scrollToTop();
          } catch (error) {
            console.error(error);
          }
        },

        storeFilterElement(el) {
          this.filterElements = document.querySelectorAll('#filters .filter-item');
          let checkboxes = document.querySelectorAll('#filters .filter-item .form-input__checkbox input');

          this.filterElements.forEach(filterEl => {
            filterEl.addEventListener('optionChange', (e) => {
              if (!this.affectedFilters.includes(filterEl)) this.affectedFilters.push(filterEl);
            })
          })

          checkboxes.forEach(el => {
            el.addEventListener('change', e => e.target.dispatchEvent(optionChange))
          });
        },

        resetFilters() {
          this.affectedFilters.forEach(el => {
            el.querySelectorAll('input').forEach(e => e.checked = false);

          })
          this.affectedFilters = [];
        },

        applyFilters() {
          var filtersData = [];
          let data = {
            name: '',
            type: '',
            values: []
          };

          this.affectedFilters.forEach((el) => {
            data = {
              values: []
            };
            data.name = el.getAttribute('data-name');
            data.type = el.getAttribute('data-type');

            if (data.type === 'checkbox') {
              let checked = el.querySelectorAll('input:checked');
              checked.forEach((checkedEl) => {
                data.values.push(checkedEl.getAttribute('data-value'));
              })
            }

            filtersData.push(data);
          });

          return filtersData;
        },

        scrollToTop() {
          window.scrollTo({
            top: 0,
            behavior: 'smooth'
          });
        }
      });
    });
  </script>
</x-app-layout>