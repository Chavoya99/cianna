<!-- resources/views/components/file-upload.blade.php -->
@props(['id' => 'kardex', 'name' => 'kardex', 'accept' => 'application/pdf'])

<div class="flex flex-col items-center">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $slot }}
    </label>
    <div class="mt-1 flex items-center">
        <input id="{{ $id }}" name="{{ $name }}" type="file" accept="{{ $accept }}" class="ml-5 rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
    </div>
</div>
