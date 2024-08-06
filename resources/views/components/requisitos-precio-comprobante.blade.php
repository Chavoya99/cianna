<div class="mt-2">
    <div class="px-2">
        <x-custom-label for="reqsts">Requisitos</x-custom-label>
        <div class="relative">
            <textarea id="reqsts" name="reqsts" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cianna-orange focus:ring-cianna-orange" 
            placeholder="Avales, depósitos, comprobantes, etc." maxlength="300" 
            required >@if(old('reqsts')){{old('reqsts')}}@endif</textarea>
        <div class="absolute bottom-0 right-0 mb-2 mr-5 text-gray-500">
        <span id="reqsts-char-count">300</span> caracteres restantes
    </div>
</div>
<div class="mt-4">
    <x-custom-label>Precio (MXN)/MES</x-custom-label>
    <div class="flex items-center">
        <span>$</span><x-custom-input id="precio" name="precio" type="number" value="{{old('precio')}}" class="ml-2 w-1/4 h-8" min="0" required></x-custom-input>
    </div>
</div>
<div class="mt-4">
    <div class="flex flex-col">
        <x-custom-label for="compDom1">
            Comprobante de domicilio 1
        </x-custom-label>
        <div class="mt-1 flex">
            <input id="compDom1" name="compDom1" type="file" accept="application/pdf" class="file:bg-cianna-blue file:text-white file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray border border-cianna-gray focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange" required>
        </div>
        <label for="compDom1">(Máx. 4 MB)</label>
    </div>
    <div class="flex flex-col mt-4">
        <x-custom-label for="compDom2">
            Comprobante de domicilio 2
        </x-custom-label>
        <div class="mt-1 flex">
            <input id="compDom2" name="compDom2" type="file" accept="application/pdf" class="file:bg-cianna-blue file:text-white file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray border border-cianna-gray focus:border-cianna-orange focus:outline-none focus:ring-1 focus:ring-cianna-orange" required>
        </div>
        <label for="compDom2">(Máx. 4 MB)</label>
    </div>
</div>