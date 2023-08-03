<x-modal wire:model="show" createModal="true">
   <x-slot name="icon">
      <x-icons.icon name="usergroup"/>
   </x-slot>

   <x-slot name="header">
      Create User
   </x-slot>

   <x-slot name="fields">
      <x-forms.input label="Name" id="create_name" placeholder="Name" wire:model.defer="name"/>
      <x-forms.input label="Email" id="create_email" placeholder="Email address" type="email" wire:model.defer="email"/>
      <x-forms.input label="Password" id="create_password" type="password" placeholder="Password" wire:model.defer="password"/>
      <x-forms.input label="Confirm password" id="create_password_confirmation" type="password" placeholder="Confirm Password" wire:model.defer="password_confirmation"/>

      <x-forms.role-select
			:identifier="'create_role'"
			:label="'Assigned Roles'"
			:name="'create_role'"
			:val="''"
			wire:model.defer="role"
		/>
   </x-slot>

   <x-slot name="buttonText">
      Create
   </x-slot>
</x-modal>
