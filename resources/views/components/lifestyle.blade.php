<!-- resources/views/components/lifestyle.blade.php -->

<div class="flex flex-wrap">
    <div>
        <x-custom-label for="lifestyle">
            ¿Te consideras alguien tranquilo o alguien fiestero?
        </x-custom-label>
        <div class="flex items-center">
            <label class="mr-6">
                <input type="radio" name="lifestyle" value="d" id="lifestyle-d" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer">
                Divertido, me gusta la fiesta.
            </label>
            <label class="mr-6">
                <input type="radio" name="lifestyle" value="t" id="lifestyle-t" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer">
                Tranquilo, prefiero no salir mucho.
            </label>
            <label>
                <input type="radio" name="lifestyle" value="a" id="lifestyle-a" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer">
                Ambos, está bien tener equilibrio.
            </label>
        </div>
    </div>
</div>