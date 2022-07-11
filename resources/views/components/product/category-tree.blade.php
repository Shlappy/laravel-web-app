<div class="container">
  @foreach ($categories as $category)
    <div>
      <a href="{{ route('products', $category->slug) }}">{{ $category->name }}</a>
      
    </div>
  @endforeach
</div>