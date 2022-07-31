<x-app-layout>
    <div class="container container--lg">
        <div class="product__blocks">

            <x-products.filters id="filters" :filters="$filters" class="filter filter__products"></x-products.filters>

            <div class="product__catalog-wrapper">
                <product-list :products='@json($products)'></product-list>
            </div>

        </div>
    </div>
</x-app-layout>