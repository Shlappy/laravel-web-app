<x-app-layout>
    <div class="container container--lg">
        <div class="product__blocks">

            <x-products.filters id="filters" :filters="$filters" class="filter filter__products"></x-products.filters>

            <div class="product__catalog-wrapper" x-data x-init="$nextTick(() => {
                $store.products.ajaxButtons = document.querySelectorAll('.ajax-button');
            })" x-html="$store.products.html">
            </div>

        </div>
    </div>
</x-app-layout>