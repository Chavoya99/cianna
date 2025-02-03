<div>
    <div class="px-2">
        <x-custom-label for="desc">Descripcion del lugar</x-custom-label>
        <div class="relative">
            <textarea id="desc" name="desc" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:border-cianna-orange focus:ring-cianna-orange" 
            placeholder="Puedes añadir una breve descripción del lugar" maxlength="300" 
            required >@if(old('desc')){{old('desc')}}@endif</textarea>
        <div class="absolute bottom-0 right-0 mb-2 mr-5 text-gray-500">
        <span id="char-count">300</span> caracteres restantes
    </div>
</div>
</div>
    <div class="flex flex-wrap mt-4">
        <div class="w-1/2 px-2">
            <x-custom-label for="cod_post">Reglas</x-custom-label>
            <div class="bg-white rounded-md px-1 py-1 border border-cianna-gray mr-12">
                <x-custom-checkbox id="mascota" name="reglas[]" :checked="is_array(old('reglas')) && in_array('mascota', old('reglas'))" value="mascota" label="Se aceptan mascotas"/>
            </div>
            <div class="mt-2 bg-white rounded-md px-1 py-1 border border-cianna-gray mr-12">
                <x-custom-checkbox id="visita" name="reglas[]" :checked="is_array(old('reglas')) && in_array('visita', old('reglas'))" value="visita" label="Se aceptan visitas"/>
            </div>
            <div class="mt-2 bg-white rounded-md px-1 py-1 border border-cianna-gray mr-12">
                <x-custom-checkbox id="limpieza" name="reglas[]" :checked="is_array(old('reglas')) && in_array('limpieza', old('reglas'))" value="limpieza" label="Rigurosa limpieza"/>
            </div>
        </div>
        <div class="w-1/2 px-2 mt-8">
            <div>
                <x-custom-input id="reglaXtra" name="reglaXtra" class="w-full h-8 text-sm" value="{{old('reglaXtra')}}" placeholder="Puedes agregar otra regla"></x-custom-input>
            </div>
            <div class="flex items-center mt-2">
                <div class="mr-10">
                    <x-custom-label>¿Incluye muebles?</x-custom-label>
                    <div class="flex items-center">
                        <label class="mr-6">
                            <input type="radio" name="muebles" value="si" id="muebles-s" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" checked @if(old('muebles') == 'si') checked @endif >
                            Sí.
                        </label>
                        <label class="">
                            <input type="radio" name="muebles" value="no" id="muebles-n" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('muebles') == 'no') checked @endif>
                            No.
                        </label>
                    </div>
                </div>
                <div>
                    <x-custom-label>¿Incluye servicios?</x-custom-label>
                    <div class="flex items-center">
                        <label class="mr-6">
                            <input type="radio" name="servicios" value="si" id="servicios-s" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" checked @if(old('servicios') == 'si') checked @endif >
                            Sí.
                        </label>
                        <label class="">
                            <input type="radio" name="servicios" value="no" id="servicios-n" class="w-4 h-4 text-cianna-orange focus:ring-cianna-orange focus:ring-2 hover:cursor-pointer" @if(old('servicios') == 'no') checked @endif>
                            No.
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>