<x-filters.dropdown :attributes="$attributes">
    <x-slot name="label">
       Status
    </x-slot>
 
    <x-slot name="default">
       All
    </x-slot>

    @foreach($statuses as $status)
    <option value="{{ $status->id }}">{{ $status->name }}</option>
    @endforeach
 </x-filters.dropdown>