<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="campus"/>
	</x-slot>

	<x-slot name="header">
		Create Role
	</x-slot>

	<x-slot name="fields">
		<x-forms.input label="Tile" id="create_title" placeholder="tile" wire:model.defer="title"/>

        <x-forms.permission-select
        :identifier="'create_permission'"
        :label="'Assigned Permissions'"
        :name="'create_permission'"
        :val="''"
        wire:model.defer="permission"
    />
	</x-slot>



	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>
