<!-- resources/views/components/foto-perfil.blade.php -->
@props(['id' => 'img_perf', 'name' => 'img_perf'])

<div class="flex flex-col items-center">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $slot }}
    </label>
    <div class="mt-1 flex items-center">
        <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 0v24H0V0h24z" fill="none"/>
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </span>
        <input id="{{ $id }}" name="{{ $name }}" type="file" class="ml-5 rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
    </div>
</div>
