<!-- resources/views/components/lifestyle.blade.php -->

<div class="flex flex-wrap">
    <div>
        <x-custom-label for="lifestyle">
            ¿Cuál dirías que es tu estilo de vida?
        </x-custom-label>
        <div class="flex">
            <label class="mr-4">
                <input type="radio" name="lifestyle" value="d" id="lifestyle-d" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('lifestyle') == 'd') checked @endif >
                Divertido, me gusta la fiesta.
            </label>
            <label>
                <input type="radio" name="lifestyle" value="t" id="lifestyle-t" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('lifestyle') == 't') checked @endif>
                Tranquilo, prefiero no salir mucho.
            </label>
            <label class="ml-4">
                <input type="radio" name="lifestyle" value="a" id="lifestyle-a" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('lifestyle') == 'a' || !old('lifestyle')) checked @endif>
                Ambos, está bien tener equilibrio.
            </label>
        </div>
    </div>
</div>