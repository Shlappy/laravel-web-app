<div class="container">
  @foreach ($categories as $category)
    <div>
      <a href="{{ route('category', $category->id) }}">{{ $category->name }}</a>
      
    </div>
  
    @if (count($category->subcategory) && $withChildren)
      <x-product.subcategory-tree :subcategories="$category->subcategory"></x-product.subcategory-tree>
    @endif
  @endforeach
</div>