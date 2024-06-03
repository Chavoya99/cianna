<!-- resources/views/components/foto-perfil.blade.php -->
@props(['id' => 'img_perf', 'name' => 'img_perf', 'defaultImage' => asset('build/img/avatar-default-svgrepo-com.png')])
<div class="flex flex-col items-center py-3">
    <label for="{{ $id }}" class="block text-sm font-medium text-cianna-gray">
        {{ $slot }}
    </label>
    <div class="mt-1 flex flex-col items-center">
        <div id="imageContainer" class="inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100 mb-2">
            <img id="preview" class="h-full w-full object-cover border border-cianna-gray rounded-lg" src="{{ $defaultImage }}" alt="Imagen previa" />
        </div>
        <input id="{{ $id }}" name="{{ $name }}" type="file" class="text-sm rounded-md cursor-pointer bg-cianna-gray border border-cianna-gray focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange" onchange="previewImage(this)">
    </div>
</div>
