<li {{ $attributes->merge([]) }} class="menu__item">
  <a href="{{ $href }}">
    {{ $slot }}
  </a>
</li>