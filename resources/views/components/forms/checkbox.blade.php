@props(['label' => '', 'placeholder' => '', 'id' => '', 'name' => $id, 'type' => 'checkbox'])
<label class="block text-sm">
    <span class="text-gray-700 font-semibold dark:text-gray-300">{{ $label }}</span>
    <input class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded @error($id) border-red-500 dark:border-red-400 @enderror"

        {{ $attributes }}
        placeholder="{{ $placeholder }}"
        id="{{ $id }}"
        name="{{ $name }}"
        type="{{ $type }}"
        
    />
@error($id)
<span class="text-xs text-red-600 dark:text-red-400">
    {{ $message }}
</span>
@enderror
</label>
