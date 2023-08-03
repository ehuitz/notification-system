
@section('title', 'Notifications')
<x-slot name="header">
    @if(request()->user()->is_admin())
        Dashboard
    @else
        My Notifications
    @endif
</x-slot>

<div class="max-w-7xl sm:px-6 lg:px-8 pb-6">
    <div class="mb-2 md:flex md:flex-inline items-end justify-between">
        <div class="md:flex md:flex-inline w-full md:space-x-2 space-y-2 md:space-y-0">
            @if(request()->user()->is_admin())
            <x-filters.status-dropdown wire:model="status"/>
            @endif
        </div>
        <div class="md:mb-0 md:mt-0 mb-4 mt-4 md:w-1/3">
            <x-forms.search-input
                wire:model.debounce.500ms="search"
                placeholder="Search..."
            />
        </div>
    </div>

    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left
                        text-gray-400 uppercase border-b dark:border-gray-700
                        bg-gray-50 dark:text-gray-500 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">From</th>
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Completed At</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($notifications as $notification)
                    <tr class="text-gray-700 dark:text-gray-400 cursor-pointer hover:bg-gray-200
                        dark:hover:bg-gray-600">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                {{-- <span class="inline-block w-2 h-2 mr-4 dark:bg-green-400 bg-green-500 rounded-full"></span> --}}
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img
                                        class="object-cover w-full h-full rounded-full"
                                        src="https://i.pravatar.cc/100?u={{ $notification->owner->id}}"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <p class="font-semibold dark:text-gray-200"
                                    >
                                        {{ $notification->owner->name  ?? 'Unknown'}}
                                    </p>
                                </div>
                            </div>
                        </td>


                        <td class="px-4 py-3 text-xs dark:text-gray-200">
                            <p class="line-clamp-1">
                                {{ \Illuminate\Support\Str::limit($notification->title, 20, $end='...') }}
                            </p>
                        </td>

                        <td class="px-4 py-3 text-xs dark:text-gray-200">
                            <p class="line-clamp-1">
                                {{ \Illuminate\Support\Str::limit($notification->content, 20, $end='...') }}
                            </p>
                        </td>



                        <td class="px-4 py-3 text-xs dark:text-gray-200">
                            {{ $notification->created_at->diffForHumans() }}
                        </td>
                        <td class="px-4 py-3 text-xs dark:text-gray-200">
                            {{ $notification->excecuted_at }}
                        </td>
                        <td class="px-4 py-3 text-xs max-w-sm">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                text-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-700
                                bg-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-100
                                dark:bg-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-700
                                dark:text-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-100"
                            >
                                {{ $notification->status->name ?? '-'}}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if (!$notifications->count())
            <tr>
                <p class="dark:text-gray-300 text-center mt-4 font-medium
                    text-gray-600">There are currently no notifications </p>
            </tr>
        @endif
    </div>
    {{ $notifications->links() }}
</div>
