<x-app-layout>
    <div class="container container--lg">
        <div class="product__blocks">

            <x-products.filters id="filters" :filters="$filters" class="filter filter__products"></x-products.filters>

            <div class="product__catalog-wrapper" x-data>
                <x-product.product-list :products="$products"></x-product.product-list>
            </div>

        </div>
    </div>
</x-app-layout>