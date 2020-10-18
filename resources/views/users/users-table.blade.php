<!-- BEGIN: Users Layout -->
@foreach ($users as $user)
<div class="intro-y col-span-12 md:col-span-6">
    <div class="box">
        <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                    src="{{asset('dist/images/profile-13.jpg')}}">
            </div>
            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                <a href="" class="font-medium">{{ $user['first_name'].' '.$user['last_name'] }}</a>
                <div class="text-gray-600 text-xs">Frontend Engineer</div>
            </div>
            <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                <a href=""
                    class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip"
                    title="Facebook"> <i class="w-3 h-3 fill-current" data-feather="facebook"></i> </a>
                <a href=""
                    class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip"
                    title="Twitter"> <i class="w-3 h-3 fill-current" data-feather="twitter"></i> </a>
                <a href=""
                    class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-dark-5 ml-2 text-gray-500 zoom-in tooltip"
                    title="Linked In"> <i class="w-3 h-3 fill-current" data-feather="linkedin"></i> </a>
            </div>
        </div>
        <div class="flex flex-wrap lg:flex-no-wrap items-center justify-center p-5">
            <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                <div class="flex">
                    <div class="text-gray-600 text-xs mr-auto">Progress</div>
                    <div class="text-xs font-medium">20</div>
                </div>
                <div class="w-full h-1 mt-2 bg-gray-400 dark:bg-dark-1 rounded-full">
                    <div class="w-1/4 h-full bg-theme-1 dark:bg-theme-10 rounded-full"></div>
                </div>
            </div>
            <button class="button button--sm text-white bg-theme-1 mr-2">Message</button>
            <button
                class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300">Profile</button>
        </div>
    </div>
</div>
@endforeach
{{ $users->links('vendor.pagination.tailwind') }}
<!-- END: Users Layout -->
