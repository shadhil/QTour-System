@if (sizeof($names) > 0)
@foreach ($names as $name)
<div class="intro-y col-span-12 md:col-span-6">
    <div class="box">
        <div class="flex flex-col lg:flex-row items-center p-5">
            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                    src="{{ asset('dist/images/user-200.png') }}">
            </div>
            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                <a href="" class="font-medium">{{ $name->full_name }}</a>
                <div class="text-gray-600 text-xs">{{ $name->name }}</div>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <button
                    class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 visitor-edit"
                    data-visitor-id={{$name->id}}
                    onclick="onEditVisitor(this.getAttribute('data-visitor-id'))">Edit</button>
            </div>
        </div>
    </div>
</div>
@endforeach
{{ $names->links('vendor.pagination.tailwind') }}

@else
<div class="intro-y col-span-12">
    <div class="w-full">
        <div class="text-center text-gray-600 font-medium p-4">NO VISITORS' NAMES FOUND</div>
    </div>
</div>
@endif
