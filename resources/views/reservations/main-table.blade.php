<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-no-wrap">GROUP NAME</th>
                <th class="text-center whitespace-no-wrap">VISITORS</th>
                <th class="text-center whitespace-no-wrap">DATE</th>
                <th class="whitespace-no-wrap">PERMIT HOLDER</th>
                <th class="text-center whitespace-no-wrap">ACTIONS</th>
            </tr>
        </thead>
        <tbody>


            @foreach (array_slice($fakers, 0, 9) as $faker)
            <tr class="intro-x border border-gray-500 zoom-in">
                <td>
                    <a href="" class="font-medium whitespace-no-wrap truncate">{{ $faker['products'][0]['name'] }}</a>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">
                        {{ $faker['products'][0]['category'] }}
                    </div>
                </td>
                <td class="text-center">{{ $faker['stocks'][0] }}</td>
                <td class="text-center">12/10/2020 - 12/12/2102</td>
                <td>
                    <a href="" class="font-normal whitespace-no-wrap">{{ $faker['products'][0]['name'] }}</a>
                </td>
                <td class="table-report__action w-56">
                    <div class="flex justify-center items-center">
                        <a class="flex items-center mr-3" href="javascript:;">
                            <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                        </a>
                        <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal"
                            data-target="#delete-confirmation-modal">
                            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- BEGIN: Pagination -->
{{-- {{ $users->links('vendor.pagination.tailwind') }} --}}
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
