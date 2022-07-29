import Alpine from 'alpinejs'

Alpine.store('products', {
  list: app.products,
  pagination: app.pagination,
  filterElements: [],
  affectedFilters: [],
  responseMessage: '',
  responseStatus: '',

  init() {
    this.filterElements = document.querySelectorAll('#filters [data-role="filter"]');
    let elements = document.querySelectorAll('#filters [data-role="filter"] input');

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
  async get(url = window.location.href, all = false) {
    var filters = [];

    if (this.affectedFilters.length && !all) filters = this.applyFilters();

    try {
      this.disableButtons();

      await axios.post(url, { filters })
        .then(response => {
          if (response.data.status === 'empty') {
            this.list = null;
            this.pagination = null;
            this.responseStatus = response.data.status;
            this.responseMessage = response.data.message;
            return;
          }

          this.list = response.data.products;
          this.pagination = response.data.pagination;
          this.responseStatus = response.data.status;
          this.responseMessage = response.data.message;
        });

      scrollToTop();
    } catch (error) {
      console.error(error);
    } finally {
      this.disableButtons(false);
    }
  },

  // Get all products and reset filter
  getAll(url = window.location.href) {
    this.get(url, true);
    this.resetFilters();
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

  // Disable buttons while AJAX calls
  disableButtons(state = true) {
    const ajaxButtons = document.querySelectorAll('.ajax-button');

    ajaxButtons.forEach((e) => {
      if (state) {
        e.setAttribute('disabled', 'disabled');
        e.classList.add('disabled');
      } else {
        e.removeAttribute('disabled');
        e.classList.remove('disabled');
      }
    });
  },
});