@foreach ($subcategories as $subcategory)
 <ul>
    <li>{{ $subcategory->name }}</li> 
    @if (count($subcategory->subcategory))
      <x-product.subcategory-tree :subcategories="$subcategory->subcategory"></x-product.subcategory-tree>
    @endif
 </ul> 
@endforeach