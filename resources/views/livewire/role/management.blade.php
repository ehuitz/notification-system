@section('title', 'Roles')

<x-table.layout
    itemCount="{{ $roles->count() }}"
    noItemsMessage="No Roles Available"
    createModal="true"
>
    <x-slot name="header">
        {{ __('Manage Roles') }}
    </x-slot>

    <x-slot name="columns">
        <th class="px-4 py-3">Name</th>
        <th class="px-4 py-3">Permissions</th>
        <th class="px-4 py-3">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($roles as $role)
        <tr id="{{ $role->id }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm dark:text-gray-200">
                {{ $role->title }}
            </td>

            <td class="px-1 py-1 text-xs dark:text-gray-200">
                @foreach($role->permissions as $permission)
                <span class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">

                    {{ $permission->title }}@if(!$loop->last)</span>, @endif

                @endforeach
            </td>

            <td class="px-4 py-3 text-sm space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $role->id }}" updateModal="true"/>
            </td>
        </tr>
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $roles->links() }}
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
                    Livewire.emit('deleteRole', id);
                }
            })
        };
        </script>
    </x-slot>
</x-table.layout>
