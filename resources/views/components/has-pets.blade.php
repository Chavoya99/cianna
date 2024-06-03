<!-- resources/views/components/fhas-pets.blade.php -->

<div class="flex flex-wrap">
    <div class="bg-cianna-white">
        <x-custom-label for="mascota">
            ¿Tienes mascotas?
        </x-custom-label>
        <div class="flex items-center">
            <label class="mr-2">
                <input type="radio" name="mascota" value="si" id="mascota-si" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2">
                Sí
            </label>
            <label>
                <input type="radio" name="mascota" value="no" id="mascota-no" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2">
                No
            </label>
        </div>
    </div>
    <div class="flex items-end md:w-1/2 px-3 md:mb-0 bg-cianna-white">
        <input class="appearance-none w-60 text-sm text-gray-600 border rounded leading-tight focus:ring-cianna-orange focus:bg-white focus:border-cianna-orange hover:disabled:cursor-not-allowed" id="num-mascotas" name="num-mascotas" type="number" min="1" placeholder="¿Cuántas mascotas tienes?" disabled>
    </div>
</div>
