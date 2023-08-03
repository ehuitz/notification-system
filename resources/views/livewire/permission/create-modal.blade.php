<x-modal wire:model="show" createModal="true">
	<x-slot name="icon">
		<x-icons.icon name="campus"/>
	</x-slot>

	<x-slot name="header">
		Create Permission
	</x-slot>

	<x-slot name="fields">
		<x-forms.input label="Tile" id="create_title" placeholder="tile" wire:model.defer="title"/>

	</x-slot>



	<x-slot name="buttonText">
		Create
	</x-slot>
</x-modal>
