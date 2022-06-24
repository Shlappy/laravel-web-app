@props([
  'type' => 'primary'  
])

<button {{ $attributes->class([
  'button', 'button__primary' => $type === 'primary', 'button__secondary' => $type === 'secondary'
  ])->merge() }}>
  {{ $slot }}
</button>
