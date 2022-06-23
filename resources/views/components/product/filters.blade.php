<div {{ $attributes }}>
  @foreach ($filters as $filter)
    <x-products.filter-item :type="$filter['type']" :filter="$filter"></x-products.filter-item>
  @endforeach
</div>