<div class="py-4 text-gray-500 dark:text-gray-400">
    <div class="text-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}">
                <x-logo class="w-auto h-14 mx-auto text-indigo-600" />
            </a>
        </div>

        <a class="text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
           Notification System
        </a>

    </div>
    <ul class="mt-6">
        @if (auth()->user()->is_admin())
            <x-nav.side-nav-link title="Notifications" icon="ticket" active="{{ request()->routeIs('notifications.index') }}"
                link="{{ route('notifications.index') }}" />
            <hr class="mx-4">

            @can('management_user_access')
                <x-nav.user-management />
            @endcan

            @else
        <x-nav.side-nav-link title="My Notifications" icon="ticket" active="{{ request()->routeIs('requests.index') }}"
            link="{{ route('requests.index') }}" />
            @endif
    </ul>



    <div class="px-6 my-6">
        <a href="{{ route('requests.create') }}"
            class="flex items-center justify-between px-4 py-2
                text-xs font-medium leading-5 text-white transition-colors
                duration-150 bg-blue-600 border border-transparent rounded-lg
                active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
            Create Notification
            <span class="ml-2" aria-hidden="true">+</span>
        </a>
    </div>
</div>
