<div class="py-3">
    <div class="px-2">
        <x-custom-label for="domicilio">Domicilio</x-custom-label>
        <x-custom-input id="domicilio" name="domicilio" required></x-custom-input>
    </div>
    <div class="flex flex-wrap mt-12">
        <div class="w-1/3 px-2">
            <x-custom-label for="cod_post">Código postal</x-custom-label>
            <x-custom-input id="cod_post" name="cod_post" class="w-full" required></x-custom-input>
        </div>
        <div class="w-1/3 px-2">
            <x-custom-label for="ciudad">Ciudad</x-custom-label>
            <x-custom-input id="ciudad" name="ciudad" class="w-full" required></x-custom-input>
        </div>
        <div class="w-1/3 px-2">
            <x-custom-label for="colonia">Colonia</x-custom-label>
            <x-custom-input id="colonia" name="colonia" class="w-full" required></x-custom-input>
        </div>
    </div>
</div>
