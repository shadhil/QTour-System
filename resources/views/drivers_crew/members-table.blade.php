<!-- BEGIN: members Layout -->
@foreach ($members as $member)
<div class="intro-y col-span-12 md:col-span-6">
    <div class="box">
        <div class="flex flex-col lg:flex-row items-center p-5">
            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                    src="{{asset(empty($member->photo) ? 'dist/images/profile-13.jpg' : $member->photo)}}">
            </div>
            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                <a href="" class="font-medium">{{ $member->first_name.' '.$member->last_name }}</a>
                <div class="text-gray-600 text-xs">{{ $member->job_title }}</div>
            </div>
            <div class="flex mt-4 lg:mt-0">
                @if (empty($member->reservation_id))
                <button
                    class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 mr-2">Available</button>
                @else
                <button class="button button--sm text-white bg-theme-1 mr-2">Booked</button>
                @endif
                <button
                    class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300 view__profile"
                    data-member-id={{ $member->id }}>Profile</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END: members Layout -->
{{ $members->links('vendor.pagination.tailwind') }}