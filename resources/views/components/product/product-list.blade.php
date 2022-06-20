<div class="product-card__list">
  @foreach ($products as $product)
    <x-products.product-item 
      :name="$product->name" 
      :price="$product->price" 
      :oldPrice="$product->old_price" 
      :images="$product->images"
    >
    </x-products.product-item>
  @endforeach
</div>

{{ $products->links() }}