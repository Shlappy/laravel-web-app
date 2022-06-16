<div class="product-card__list">
  @foreach ($products as $product)
    <x-product-item 
      :name="$product->name" 
      :price="$product->price" 
      :oldPrice="$product->old_price" 
      :images="$product->images"
    >
    </x-product-item>
  @endforeach
</div>

{{ $products->links() }}