<div {{ $attributes }}>
  @foreach ($filters as $key => $filter)
    <x-products.filter-item :filter="[$key => $filter]"></x-products.filter-item>
  @endforeach
</div>