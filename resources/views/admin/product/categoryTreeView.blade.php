@foreach ($parentCategories as $category)
  <div>
    {{$category->name}}
  </div>

  @if (count($category->subcategory))
    @include ('admin.product.subCategoryList', ['subcategories' => $category->subcategory])
  @endif
@endforeach