@props([
  'type', 
  'min' => null, 
  'max' => null
])

<div class="slider">
  <div 
    {{ $attributes->merge(['class' => 'slider-'.$type]) }} 
    {{ !is_null($max) ? 'max='.$max : ''}} {{ !is_null($min) ? 'min='.$min : ''}}
    >
  </div>

  @if ($type === 'between')
  <div class="form-input__row">
    <input type="number" name="min" min="{{ $min }}" max="{{ $max }}" class="form-input">
    <input type="number" name="max" min="{{ $min }}" max="{{ $max }}" class="form-input">
  </div>
  @endif
</div>
