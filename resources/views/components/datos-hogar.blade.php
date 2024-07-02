<div class="py-3">
    <x-custom-label class=" flex text-lg px-2">Domicilio</x-custom-label>
    <div class="flex flex-wrap">
        <div class="w-4/6 px-2">
            <x-custom-label for="calle">Calle</x-custom-label>
            <x-custom-input id="calle" name="calle" class="w-full" value="{{old('calle')}}" required></x-custom-input>
        </div>
        <div class="w-1/6 px-2">
            <x-custom-label for="num_ext">N° ext.</x-custom-label>
            <x-custom-input id="num_ext" name="num_ext" class="w-full" type="number" value="{{old('num_ext')}}" min="1" required></x-custom-input>
        </div>
        <div class="w-1/6 px-2">
            <x-custom-label for="num_int">N° int.</x-custom-label>
            <x-custom-input id="num_int" name="num_int" class="w-full" value="{{old('num_int')}}" min="1" type="number"></x-custom-input>
        </div>
    </div>
    <div class="flex flex-wrap mt-12">
        <div class="w-1/5 px-2">
            <x-custom-label for="cod_post">C.P.</x-custom-label>
            <x-custom-input id="cod_post" name="cod_post" class="w-full" type="number" value="{{old('cod_post')}}" min="1" required></x-custom-input>
        </div>
        <div class="w-2/5 px-2">
            <x-custom-label for="ciudad">Ciudad</x-custom-label>
            <x-custom-input id="ciudad" name="ciudad" class="w-full" value="{{old('ciudad')}}" required></x-custom-input>
        </div>
        <div class="w-2/5 px-2">
            <x-custom-label for="colonia">Colonia</x-custom-label>
            <x-custom-input id="colonia" name="colonia" class="w-full" value="{{old('colonia')}}" required></x-custom-input>
        </div>
    </div>
</div>
