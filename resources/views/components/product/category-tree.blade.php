<div class="container">
  <h1>{{ __('app.catalog') }}</h1>

  @foreach ($categories as $category)
    <div>
      <a href="{{ route('products', $category->slug) }}">{{ $category->name }}</a>
      
    </div>
  @endforeach
</div>