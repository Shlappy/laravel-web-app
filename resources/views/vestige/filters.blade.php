<div {{ $attributes }}>
  @foreach ($filters as $filter)
    <x-products.filter-item :type="$filter['type']" :filter="$filter"></x-products.filter-item>
  @endforeach

  <div class="filter__buttons" x-data>
    <x-general.button class="ajax-button" type="primary" data-type="apply-filters">Применить</x-general.button>
    <x-general.button class="ajax-button" type="secondary" data-type="reset-filters">Сбросить</x-general.button>
  </div>
</div>