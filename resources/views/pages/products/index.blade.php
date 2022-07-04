<x-app-layout>
  <div class="container container--lg">
    <div class="product__blocks">

      <x-products.filters id="filters" :filters="$filters" class="filter filter__products"></x-products.filters>

      <div class="product__catalog-wrapper" x-data x-html="$store.products.html">
      </div>

    </div>
  </div>
  <script>
    // Event to check if any of filter elements have been changed
    var optionChange = new Event('optionChange', {
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

        init() {
          this.filterElements = document.querySelectorAll('#filters .filter-item');
          let elements = document.querySelectorAll('#filters .filter-item input');

          this.filterElements.forEach(filterEl => {
            filterEl.addEventListener('optionChange', (e) => {
              if (filterEl.getAttribute('data-type') === 'checkbox' &&
                !filterEl.querySelectorAll('input:checked').length
              ) {
                this.affectedFilters = this.affectedFilters.filter(item => item !== filterEl);
                return;
              }

              if (!this.affectedFilters.includes(filterEl)) {
                this.affectedFilters.push(filterEl);
              }
            })
          });

          elements.forEach(el => {
            el.addEventListener('change', e => e.target.dispatchEvent(optionChange))
          });
        },

        // Get products with selected filters
        async get(url = window.location.href) {
          var filters = [];

          if (this.affectedFilters.length) filters = this.applyFilters();

          try {
            await axios.post(url, {
                filters
              })
              .then(response => {
                this.html = response.data
              });

            scrollToTop();
          } catch (error) {
            console.error(error);
          }
        },

        // Get all products
        async getAll(url = window.location.href) {
          try {
            await axios.get(url)
              .then(response => this.html = response.data);

            this.resetFilters();
            scrollToTop();
          } catch (error) {
            console.error(error);
          }
        },

        // Reset filter to its initial state
        resetFilters() {
          this.affectedFilters.forEach(el => {
            const type = el.getAttribute('data-type');
            if (type === 'checkbox') {
              el.querySelectorAll('input[type="checkbox"]').forEach(e => {
                e.checked = false;
              });
            }

            if (type === 'between') {
              let min = el.querySelector('input[name="min"]').getAttribute('min'),
                max = el.querySelector('input[name="max"]').getAttribute('max');
              el.querySelector('[data-role="filter"]').noUiSlider.set([min, max]);
            }
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

            if (data.type === 'between') {
              let min = el.querySelector('input[name="min"]'),
                max = el.querySelector('input[name="max"]');
              data.values.push(min.value, max.value);
            }

            filtersData.push(data);
          });

          return filtersData;
        },
      });
    });
  </script>
</x-app-layout>