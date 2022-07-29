<div class="product-card__list" x-data="{ products: $store.products.list }" x-modelable="$store.products.list" x-model="products">
  <template x-if="products">
    <template x-for="productItem in products" :key="productItem.id">
      <x-product.product-item></x-product.product-item>
    </template>
  </template>
</div>

<div>
  <template x-if="$store.products.responseStatus === 'empty'">
    <div x-text="$store.products.responseMessage"></div>
  </template>
</div>

<div x-html="$store.products.pagination">
  {{ $products->links() }}
</div>