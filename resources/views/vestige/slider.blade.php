@props([
  'type', 
  'min' => null, 
  'max' => null
])

<div class="slider-wrapper filter-item__slider pd">
  <div 
    {{ $attributes->merge(['class' => 'slider slider-'.$type]) }} 
    {{ !is_null($max) ? 'max='.$max : ''}} {{ !is_null($min) ? 'min='.$min : ''}}
    >
  </div>

  @if ($type === 'between')
  <div class="form-input__row">
    <input type="number" name="min" min="{{ $min }}" max="{{ $max }}" class="form-input slider__input slider__input-min">
    <input type="number" name="max" min="{{ $min }}" max="{{ $max }}" class="form-input slider__input slider__input-max">
  </div>
  @endif
</div>
