<!-- resources/views/components/has-pets.blade.php -->

<div class="flex flex-wrap">
    <div>
        <x-custom-label for="mascota">
            ¿Tienes mascotas?
        </x-custom-label>
        <div class="flex items-center">
            <label class="mr-8">
                <input type="radio" name="mascota" value="si" id="mascota-si" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('mascota')== 'si') checked @endif>
                Sí
            </label>
            <label>
                <input type="radio" name="mascota" value="no" id="mascota-no" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" checked @if(old('mascota')== 'no') checked @endif>
                No
            </label>
        </div>
    </div>
    <div class="flex items-end md:w-1/2 px-10    md:mb-0 bg-cianna-white">
        <input class="appearance-none w-60 text-sm text-gray-600 border rounded leading-tight focus:ring-cianna-orange focus:bg-white focus:border-cianna-orange hover:disabled:cursor-not-allowed" id="num-mascotas" name="num-mascotas" type="number" min="1" placeholder="¿Cuántas mascotas tienes?" @if(old('mascota') == 'si') value="{{old('num-mascotas')}}" @else disabled @endif>
    </div>
</div>
