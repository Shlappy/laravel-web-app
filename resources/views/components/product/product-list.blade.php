<div class="product-card__list">
  @foreach ($products as $product)
    <x-products.product-item :product="$product"></x-products.product-item>
  @endforeach
</div>

{{ $products->links() }}