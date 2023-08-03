<x-modal wire:model="show" editModal="true">
	<x-slot name="icon">
		<x-icons.icon name="annotation"/>
	</x-slot>

	<x-slot name="header">
		Edit Role
	</x-slot>

	<x-slot name="fields">
		<x-forms.input label="Title" id="edit_title" placeholder="Title" wire:model.defer="title"/>

        <x-forms.permission-select
        :identifier="'create_permission'"
        :label="'Assigned Permissions'"
        :name="'create_permission'"
        :val="''"
        wire:model.defer="permission"
    />
    </x-slot>

	<x-slot name="buttonText">
		Update
	</x-slot>
</x-modal>
