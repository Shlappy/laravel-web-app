<div class="product-card__list" x-data="{ products: $store.products.list }" x-modelable="$store.products.list" x-model="products">
  <template x-for="product in products">
    <x-product.product-item></x-product.product-item>
  </template>
  {{-- @foreach ($products as $product)
    <x-product.product-item :product="$product"></x-product.product-item>
  @endforeach --}}
</div>

{{ $products->links() }}
