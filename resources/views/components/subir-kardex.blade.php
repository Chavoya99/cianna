<!-- resources/views/components/file-upload.blade.php -->
@props(['id' => 'kardex', 'name' => 'kardex', 'accept' => 'application/pdf'])

<div class="flex flex-col">
    <x-custom-label for="$id">
        Sube aquí tu kárdex
    </x-custom-label>
    <div class="mt-1 flex">
        <input id="{{ $id }}" name="{{ $name }}" type="file" accept="{{ $accept }}" class="block w-full file:bg-cianna-blue file:text-white file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray border border-cianna-gray focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange">
    </div>
</div>
