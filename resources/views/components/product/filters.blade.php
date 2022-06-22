<div {{ $attributes }}>
  @foreach ($filters as $filter)
    <x-products.filter-item :filter="$filter"></x-products.filter-item>
  @endforeach
</div>