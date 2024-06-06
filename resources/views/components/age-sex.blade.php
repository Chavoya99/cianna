<!-- resources/views/components/age-sex.blade.php -->

<div class="flex flex-wrap mt-1">
    <div class="justify-start sm:justify-start md:justify-start">
        <x-custom-label for="edad" class="text-center">Edad</x-custom-label>
        <input id="edad" name="edad" class="block w-24 focus:border-cianna-orange focus:ring-cianna-orange border border-cianna-gray rounded-md" type="number" min="18" max="35" :value="old('edad')"  placeholder="18 a 35" required autocomplete="edad">
    </div>
    <div class="ml-auto">
        <x-custom-label for="sexo" class="text-center">Sexo</x-custom-label>
        <x-custom-select id="sexo" name="sexo" class="block w-36">
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
        </x-custom-select>
    </div>
</div>