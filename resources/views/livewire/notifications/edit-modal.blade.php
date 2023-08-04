<x-modal wire:model="show" editModal="true">
   <x-slot name="icon">
      <x-icons.icon name="usergroup"/>
   </x-slot>

   <x-slot name="header">
      Edit Notification
   </x-slot>

   <x-slot name="fields">
      <x-forms.input
         label="Title"
         id="edit_title"
         placeholder="Title"
         wire:model.defer="title"/>

         <x-forms.input
         label="Content"
         id="edit_content"
         placeholder="Content"
         wire:model.defer="content"/>

         <x-forms.datetime label="Date:" id="edit_date"  wire:model.defer="date"/>
   </x-slot>

   <x-slot name="buttonText">
      Update
   </x-slot>
</x-modal>
