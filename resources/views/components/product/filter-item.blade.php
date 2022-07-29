<div data-role="filter" data-name="{{ $filter['slug'] }}" data-type="{{ $filter['type'] }}" class="filter-item" x-data="{ toggle: false }">
  <div class="filter-item__wrapper">

    <a 
      @click.prevent="toggle = !toggle"
      {{ $attributes->class(['filter-item__toggle', 'collapsible', 'filter-item__toggle--between' => $type === 'between', 'pd']) }} 
      href="#"
    >
      {{ $filter['name'] }}
    </a>

    <div class="filter-item__inner" :class="toggle || 'filter-hidden'">
      <div class="filter-item__content">

        @if ($type === 'between')
          <x-general.slider 
            data-role="filter"
            data-value="{{ $filter['name'] }}"
            :min="$filter['min'] === $filter['max'] ? 0 : $filter['min']" 
            :max="$filter['max']" 
            :type="$type" 
            class="slider-product">
          </x-general.slider>
        @endif

        @if ($type === 'checkbox')
          <ul class="filter-item__list">
            @foreach ($filter['values'] as $value)
              <label class="filter-item__list-item form-input__checkbox pd">
                <span>{{ $value['value'] }}</span>
                <input type="checkbox" class="form-input__checkbox-input" data-value="{{ $value['code'] }}">
              </label>
            @endforeach 
          </ul>
        @endif

      </div>
    </div>
    
  </div>
</div>
