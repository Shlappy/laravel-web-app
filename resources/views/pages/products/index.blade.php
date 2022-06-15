<div class="container">
  @foreach ($products as $product)
    <x-product-item :name="$product->name" :price="$product->price" :oldPrice="$product->old_price">
    </x-product-item>
  @endforeach
</div>

{{ $products->onEachSide(5)->links() }}