@extends('../layout/main')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Accordion
    </h2>
</div>
<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <!-- BEGIN: Boxed Accordion -->
    <div class="col-span-12 lg:col-span-12">
        <div class="intro-y box">
            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Boxed Accordion
                </h2>
                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <div class="mr-3">Show example code</div>
                    <input data-target="#boxed-accordion" class="show-code input input--switch border" type="checkbox">
                </div>
            </div>
            <div class="p-5" id="boxed-accordion">
                <div class="preview">
                    <div class="accordion">
                        <div class="accordion__pane active border border-gray-200 dark:border-dark-5 p-4">
                            <a href="javascript:;" class="accordion__pane__toggle font-medium block">OpenSSL Essentials:
                                Working with SSL Certificates, Private Keys</a>
                            <div class="accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged.</div>
                        </div>
                        <div class="accordion__pane border border-gray-200 dark:border-dark-5 p-4 mt-3">
                            <a href="javascript:;" class="accordion__pane__toggle font-medium block">Understanding IP
                                Addresses, Subnets, and CIDR Notation</a>
                            <div class="accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged.</div>
                        </div>
                        <div class="accordion__pane border border-gray-200 dark:border-dark-5 p-4 mt-3">
                            <a href="javascript:;" class="accordion__pane__toggle font-medium block">How To Troubleshoot
                                Common HTTP Error Codes</a>
                            <div class="accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged.</div>
                        </div>
                        <div class="accordion__pane border border-gray-200 dark:border-dark-5 p-4 mt-3">
                            <a href="javascript:;" class="accordion__pane__toggle font-medium block">An Introduction to
                                Securing your Linux VPS</a>
                            <div class="accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                has been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took a galley of type and scrambled it to make a type specimen book. It has
                                survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged.</div>
                        </div>
                    </div>
                </div>
                <div class="source-code hidden">
                    <button data-target="#copy-boxed-accordion"
                        class="copy-code button button--sm border border-gray-200 dark:border-dark-5 flex items-center text-gray-700">
                        <i data-feather="file" class="w-4 h-4 mr-2"></i> Copy example code </button>
                    <div class="overflow-y-auto h-64 mt-3">
                        <pre class="source-preview"
                            id="copy-boxed-accordion"> <code class="text-xs p-0 rounded-md html pl-5 pt-8 pb-4 -mb-10 -mt-10"> HTMLOpenTagdiv class=&quot;accordion&quot;HTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane active border border-gray-200 dark:border-dark-5 p-4&quot;HTMLCloseTag HTMLOpenTaga href=&quot;javascript:;&quot; class=&quot;accordion__pane__toggle font-medium block&quot;HTMLCloseTagOpenSSL Essentials: Working with SSL Certificates, Private KeysHTMLOpenTag/aHTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed&quot;HTMLCloseTagLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.HTMLOpenTag/divHTMLCloseTag HTMLOpenTag/divHTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane border border-gray-200 dark:border-dark-5 p-4 mt-3&quot;HTMLCloseTag HTMLOpenTaga href=&quot;javascript:;&quot; class=&quot;accordion__pane__toggle font-medium block&quot;HTMLCloseTagUnderstanding IP Addresses, Subnets, and CIDR NotationHTMLOpenTag/aHTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed&quot;HTMLCloseTagLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.HTMLOpenTag/divHTMLCloseTag HTMLOpenTag/divHTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane border border-gray-200 dark:border-dark-5 p-4 mt-3&quot;HTMLCloseTag HTMLOpenTaga href=&quot;javascript:;&quot; class=&quot;accordion__pane__toggle font-medium block&quot;HTMLCloseTagHow To Troubleshoot Common HTTP Error CodesHTMLOpenTag/aHTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed&quot;HTMLCloseTagLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.HTMLOpenTag/divHTMLCloseTag HTMLOpenTag/divHTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane border border-gray-200 dark:border-dark-5 p-4 mt-3&quot;HTMLCloseTag HTMLOpenTaga href=&quot;javascript:;&quot; class=&quot;accordion__pane__toggle font-medium block&quot;HTMLCloseTagAn Introduction to Securing your Linux VPSHTMLOpenTag/aHTMLCloseTag HTMLOpenTagdiv class=&quot;accordion__pane__content mt-3 text-gray-700 dark:text-gray-600 leading-relaxed&quot;HTMLCloseTagLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.HTMLOpenTag/divHTMLCloseTag HTMLOpenTag/divHTMLCloseTag HTMLOpenTag/divHTMLCloseTag </code> </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Boxed Accordion -->
</div>

<h2 class="intro-y text-lg font-medium mt-10">Data List Layout</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <button class="button text-white bg-theme-1 shadow-md mr-2">Add New Product</button>
        <div class="dropdown">
            <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                <span class="w-5 h-5 flex items-center justify-center">
                    <i class="w-4 h-4" data-feather="plus"></i>
                </span>
            </button>
            <div class="dropdown-box w-40">
                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                    </a>
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                    </a>
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>
    </div>
    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-no-wrap">IMAGES</th>
                    <th class="whitespace-no-wrap">PRODUCT NAME</th>
                    <th class="text-center whitespace-no-wrap">STOCK</th>
                    <th class="text-center whitespace-no-wrap">STATUS</th>
                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach (array_slice($fakers, 0, 9) as $faker)
                <tr class="intro-x">
                    <td class="w-40">
                        <div class="flex">
                            <div class="w-10 h-10 image-fit zoom-in">
                                <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                    src="{{ asset('dist/images/' . $faker['images'][0]) }}"
                                    title="Uploaded at {{ $faker['dates'][0] }}">
                            </div>
                            <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                    src="{{ asset('dist/images/' . $faker['images'][1]) }}"
                                    title="Uploaded at {{ $faker['dates'][0] }}">
                            </div>
                            <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                    src="{{ asset('dist/images/' . $faker['images'][2]) }}"
                                    title="Uploaded at {{ $faker['dates'][0] }}">
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="" class="font-medium whitespace-no-wrap">{{ $faker['products'][0]['name'] }}</a>
                        <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $faker['products'][0]['category'] }}
                        </div>
                    </td>
                    <td class="text-center">{{ $faker['stocks'][0] }}</td>
                    <td class="w-40">
                        <div
                            class="flex items-center justify-center {{ $faker['true_false'][0] ? 'text-theme-9' : 'text-theme-6' }}">
                            <i data-feather="check-square" class="w-4 h-4 mr-2"></i>
                            {{ $faker['true_false'][0] ? 'Active' : 'Inactive' }}
                        </div>
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
    <!-- END: Data List -->
    <!-- BEGIN: Pagination -->
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
</div>
<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="delete-confirmation-modal">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Are you sure?</div>
            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.
            </div>
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
            <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->
@endsection
