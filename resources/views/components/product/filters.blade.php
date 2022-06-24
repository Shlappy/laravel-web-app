<div {{ $attributes }}>
  @foreach ($filters as $filter)
    <x-products.filter-item :type="$filter['type']" :filter="$filter"></x-products.filter-item>
  @endforeach

  <div class="filter__buttons" x-data>
    <x-general.button type="primary">Применить</x-general.button>
    <x-general.button type="secondary">Сбросить</x-general.button>
  </div>
</div>