<!-- resources/views/components/foto-cuarto.blade.php -->
@props(['id' => 'img_extra', 'name' => 'img_extra', 'defaultImage' => asset('img/home-add-svgrepo-com.png')])
<div class="flex flex-col items-center py-3">
    <div class="flex flex-col items-center block w-full">
        <div id="imgContainerExtra" class="inline-block h-40 w-40 overflow-hidden rounded-md bg-gray-100 mb-2">
            <img id="previewExtra" class="object-cover border border-cianna-gray rounded-lg" src="{{ $defaultImage }}" alt="Imagen previa" />
        </div>
        <input id="{{ $id }}" name="{{ $name }}" type="file" accept=".png,.jpg,.jpeg" class="block w-full file:bg-cianna-blue file:text-white file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray border border-cianna-gray focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange" onchange="previewImgExtra(this)">
    </div>
    <label for="img_extra">Imagen extra</label>
    <label class="text-xs">Si lo deseas añade una imagen</label>
    <label class="text-xs">de cualquier otro lugar de la casa</label>
    <label class="text-xs">(Máx. 4 MB)</label>
</div>