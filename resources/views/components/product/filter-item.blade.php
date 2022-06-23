<div data-name="{{ $filter['slug'] }}" class="filter-item">
  <a class="filter-item__toggle" href="#">{{ $filter['name'] }}</a>
  <div class="filter-item__inner">
    <div class="filter-item__content">
      @if ($type === 'between')
        <x-general.slider 
          :min="$filter['min'] === $filter['max'] ? 0 : $filter['min']" 
          :max="$filter['max']" 
          :type="$type" 
          class="slider-product">
        </x-general.slider>
      @endif
    </div>
  </div>
</div>