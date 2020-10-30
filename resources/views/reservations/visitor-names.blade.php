@foreach ($fakers as $faker)
<div class="intro-y col-span-12 md:col-span-6">
    <div class="box">
        <div class="flex flex-col lg:flex-row items-center p-5">
            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                    src="{{ asset('dist/images/' . $faker['photos'][0]) }}">
            </div>
            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                <a href="" class="font-medium">{{ $faker['users'][0]['name'] }}</a>
                <div class="text-gray-600 text-xs">{{ $faker['jobs'][0] }}</div>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <button
                    class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300">Profile</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END: Pagination -->
<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
    <ul class="pagination">
        <li>
            <a class="pagination__link" href="">
                <i class="w-4 h-4" data-feather="chevrons-left"></i>
            </a>
        </li>
        <li>
            <a class="pagination__link" href="">
                <i class="w-4 h-4" data-feather="chevron-left"></i>
            </a>
        </li>
        <li>
            <a class="pagination__link" href="">...</a>
        </li>
        <li>
            <a class="pagination__link" href="">1</a>
        </li>
        <li>
            <a class="pagination__link pagination__link--active" href="">2</a>
        </li>
        <li>
            <a class="pagination__link" href="">3</a>
        </li>
        <li>
            <a class="pagination__link" href="">...</a>
        </li>
        <li>
            <a class="pagination__link" href="">
                <i class="w-4 h-4" data-feather="chevron-right"></i>
            </a>
        </li>
        <li>
            <a class="pagination__link" href="">
                <i class="w-4 h-4" data-feather="chevrons-right"></i>
            </a>
        </li>
    </ul>
    <select class="w-20 input box mt-3 sm:mt-0">
        <option>10</option>
        <option>25</option>
        <option>35</option>
        <option>50</option>
    </select>
</div>
<!-- END: Pagination -->
