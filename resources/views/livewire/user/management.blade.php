@section('title', 'Users')

<x-table.layout
    itemCount="{{ $users->count() }}"
    noItemsMessage="No Users Available"
    createModal="true"
>

    <x-slot name="header">
        {{ __('Manage Users') }}
    </x-slot>

    <x-slot name="columns">
        <th class="px-4 py-3">Name</th>
        <th class="px-4 py-3">Roles</th>

        <th class="px-4 py-3">Actions</th>
    </x-slot>

    <x-slot name="rows">
        @foreach($users as $user)
        <tr id="{{ $user->id }}" class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 dark:text-gray-200 flex items-center text-sm">
                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                    <img
                    class="object-cover w-full h-full rounded-full"
                    src="https://i.pravatar.cc/100?u={{ $user->id ?? '0'}}"
                    alt=""
                    loading="lazy"
                />
                    <div class="absolute inset-0 rounded-full shadow-inner"
                        aria-hidden="true"
                    ></div>
                </div>
                <div>
                    <p class="font-semibold dark:text-gray-200">
                        {{ $user->name }}
                    </p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                        {{ $user->email }}
                    </p>
                </div>
            </td>

            <td class="px-4 py-3 text-sm dark:text-gray-200">
                @foreach($user->roles as $key => $item)
                <span class="badge badge-info">{{ $item->title }}</span>
                @if (!$loop->last)
                            ,
                        @endif
            @endforeach
            </td>
            <td class="px-4 py-3 text-sm space-x-4 dark:text-gray-200">
                <x-table.actions id="{{ $user->id }}" updateModal="true"/>
            </td>
        </tr>
        @endforeach
    </x-slot>

    <x-slot name="links">
        {{ $users->links() }}
    </x-slot>

    <x-slot name="scripts">
        <script>
        function createItem() {
            var name = $('#create_name').val();
            var email = $('#create_email').val();
            var password = $('#password').val();
            var password2 = $('#password_confirmation').val();
            var campus = $('#create_campus').val();
            Livewire.emit('createUser', name, email, password, password2, campus);
        }

        function updateItem() {
            var id = $('#user_id').val()
            var name = $('#edit_name').val();
            var email = $('#edit_email').val();
            var campus = $('#edit_campus').val();
            Livewire.emit('updateUser', id, name, email, campus);
        }

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
                    Livewire.emit('deleteUser', id);
                }
            })
        };

        function updateModal(id) {
            var campuses = $('tr[id='+id+']').find('td:nth-child(2)').text().trim();
            var name = $('tr[id='+id+']').find('td:nth-child(1)').find('div:nth-child(2)').find('p:nth-child(1)').text().trim();
            var email = $('tr[id='+id+']').find('td:nth-child(1)').find('div:nth-child(2)').find('p:nth-child(2)').text().trim();
            Array.from(document.querySelector("#edit_campus").options).forEach(function(option) {
                option.selected = false;

                let text = option.text;

                if (campuses.includes(text))
                    option.selected = true;
            });

            $('#user_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);
        }
        </script>
    </x-slot>
</x-table.layout>
