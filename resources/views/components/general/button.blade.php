@props([
  'type' => 'primary',
  'div' => false
])

@php
  $element = 'button';
  if ($div) $element = 'div';
@endphp

<{{ $element }} {{ $attributes->class([
    'button', 
    'button__primary' => $type === 'primary', 
    'button__secondary' => $type === 'secondary',
    'button__round' => $type === 'round'
    ])->merge() }}>
  {{ $slot }}
</{{ $element }}>