@props(['label' => '', 'items', 'id' => '', 'name' => $id, 'val' => '', 'enum' => false])
<label class="block mt-4 text-sm">
    <span class="text-gray-800 font-semibold dark:text-gray-300">
        {{ $label }}
    </span>
    <select class="block w-full mt-1  text-gray-500 text-sm dark:text-gray-300 dark:border-gray-600
            dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple
            dark:focus:shadow-outline-gray border px-4 py-2 rounded-lg border-gray-200
            @error($id) border-red-500 dark:border-red-400 @enderror"
            id="{{ $id }}"
            name="{{ $name }}"
            {{ $attributes }}
    >
        @if ($val == '')
            <option value="0">Select a(n) {{ $label }}</option>
        @endif
        @if ($enum) {
            @foreach($items as $key=>$item)
                <option value="{{ $key }}" @if($val==$key) selected @endif>{{ $item }}</option>
            @endforeach
        @else
            @foreach($items as $item)
                <option value="{{ $item->id }}" @if($val==$item->id) selected @endif>{{ $item->name }}</option>
            @endforeach
        @endif
    </select>

    @error($id)
        <span class="text-xs text-red-600 dark:text-red-400">
            {{ $message }}
        </span>
    @enderror
</label>

