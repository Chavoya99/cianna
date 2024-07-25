<!-- resources/views/components/age-sex.blade.php -->

<div class="flex justify-between flex-wrap mt-1">
    <div class="sm:justify-between md:justify-between">
        <x-custom-label for="edad" class="text-center">Edad</x-custom-label>
        <input id="edad" name="edad" class="block w-24 focus:border-cianna-orange focus:ring-cianna-orange border border-cianna-gray rounded-md" 
        type="number" min="18" max="35" value="{{old('edad')}}"  placeholder="18 a 35" required autocomplete="edad">
    </div>
    <div class="w-32">
        <x-custom-label for="sexo" class="text-center">Sexo</x-custom-label>
        <x-custom-select id="sexo" name="sexo" class="block w-36">
            <option @selected(old('sexo') == 'masculino') value="masculino">Masculino</option>
            <option @selected(old('sexo') == 'femenino') value="femenino">Femenino</option>
        </x-custom-select>
    </div>
</div>