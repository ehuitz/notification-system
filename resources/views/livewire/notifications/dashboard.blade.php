<div>
@section('title', 'Notifications')
<x-table.layout
    itemCount="{{ $notifications->count() }}"
    noItemsMessage="No Notifications Available"
    createModal="false"
>
    <x-slot name="header">
        @if(request()->user()->is_admin())
            Dashboard
        @else
            My Notifications
        @endif
    </x-slot>

    <x-slot name="searchBar">
        <div class="mb-2 md:flex md:flex-inline items-end justify-between">
            <div class="md:flex md:flex-inline w-full md:space-x-2 space-y-2 md:space-y-0">
                @if(request()->user()->is_admin())
                <x-filters.status-dropdown wire:model="status"/>
                @endif
            </div>
            <div class="md:mb-0 md:mt-0 mb-4 mt-4">
                <x-forms.search-input
                    wire:model.debounce.500ms="search"
                    placeholder="Search..."
                />
            </div>
        </div>
    </x-slot>

    <x-slot name="columns">

        <th class="px-4 py-3">From</th>
        <th class="px-4 py-3">Title</th>
        <th class="px-4 py-3">Description</th>
        <th class="px-4 py-3">Scheduled For</th>
        <th class="px-4 py-3">Completed At</th>
        <th class="px-4 py-3">Status</th>

        <th class="px-4 py-3 w-40">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($notifications as $notification)
        <tr id="{{ $notification->name }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm dark:text-gray-200">
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
            <td class="px-4 py-3 text-sm dark:text-gray-200">
                <p class="line-clamp-1">
                    {{ \Illuminate\Support\Str::limit($notification->title, 20, $end='...') }}
                </p>
            </td>

            <td class="px-4 py-3 text-sm dark:text-gray-200">
                <p class="line-clamp-1">
                    {{ \Illuminate\Support\Str::limit($notification->content, 20, $end='...') }}
                </p>
            </td>
            <td class="px-4 py-3 text-sm dark:text-gray-200">
                {{ $notification->date->diffForHumans() }}
            </td>

            <td class="px-4 py-3 text-sm dark:text-gray-200">
                {{ $notification->excecuted_at ? $notification->excecuted_at->diffForHumans(): '--' }}
            </td>

            <td class="px-4 py-3 text-sm dark:text-gray-200">
                <span class="px-2 py-1 font-semibold leading-tight rounded-full
                text-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-700
                bg-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-100
                dark:bg-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-700
                dark:text-{{ $notification->status->getStatusColorAttribute($notification->status->color ?? '9') }}-100"
            >
                {{ $notification->status->name ?? '-'}}
            </span>
            </td>

            <td class="px-4 py-3 text-sm  space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $notification->id }}" updateModal="true"/>
            </td>
        </tr>
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $notifications->links() }}
    </x-slot>

    <x-slot name="scripts">
        <script>
        function deleteItem(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to reverse this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteNotification', id);
                }
            })
        };
        </script>
    </x-slot>
</x-table.layout>
</div>
