<!-- resources/views/components/has-pets.blade.php -->
<x-custom-label for="mascota">
    ¿Tienes mascotas?
</x-custom-label>
<div class="flex items-center flex-wrap">
    <div class="mr-12">
        <div class="flex items-center">
            <label class="mr-8">
                <input type="radio" name="mascota" value="si" id="mascota-si" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('mascota')== 'si' || (isset($usuario) && $usuario->mascota == 'si')) checked @endif>
                Sí
            </label>
            <label>
                <input type="radio" name="mascota" value="no" id="mascota-no" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('mascota')== 'no' || (!old('mascota') && !isset($usuario)) || (isset($usuario) && $usuario->mascota == 'no')) checked @endif>
                No
            </label>
        </div>
    </div>
    <div class="flex items-end">
        <input class="appearance-none w-[230px] text-sm text-gray-600 border rounded leading-tight focus:ring-cianna-orange focus:bg-white focus:border-cianna-orange hover:disabled:cursor-not-allowed" id="num-mascotas" name="num-mascotas" type="number" min="1" placeholder="¿Cuántas mascotas tienes?" @if(old('mascota') == 'si') value="{{old('num-mascotas')}}" @elseif (isset($usuario) && $usuario->mascota == 'si') value="{{$usuario->num_mascotas}}" @else disabled @endif>
    </div>
</div>
