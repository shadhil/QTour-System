@if (sizeof($categories) > 0)
@foreach ($categories as $category)
<a href="javascript:;"
    class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
    <div class="pos__ticket__item-name truncate mr-1">
        {{ $category->category }}</div>
    <div class=" ml-auto" data-category-id={{$category->id}} data-category="{{$category->category}}""
        onclick=" updateCategory(cash(this).attr('data-category-id'),cash(this).attr('data-category'))"><i
            data-feather="edit" class="w-4 h-4 text-gray-200 ml-2"></i></div>
    <div class=" ml-3" data-category-id={{$category->id}}
        ondblclick="removeCategory(cash(this).attr('data-category-id'))"><i data-feather="trash"
            class="w-4 h-4 text-gray-200 ml-2"></i></div>
</a>
@endforeach
@else
{{--  --}}
@endif
