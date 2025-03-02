<div>
    <div id="preferencesButton" class="flex cursor-pointer" onclick="toggleSearchPreferences()">
        <div class="flex items-center justify-center rounded-md rounded-r-none bg-gray-400">
            <i class="fa-solid fa-magnifying-glass px-2"></i>
        </div>
        <div class="flex items-center rounded-md rounded-l-none bg-gray-300 px-4 py-2">
            <i class="fa-solid fa-gear mr-2"></i>Preferencias
        </div>
    </div>
    <div id="searchPreferences"
        class="absolute z-50 mt-2 hidden w-96 rounded-md border-[1px] border-cianna-gray bg-white px-6 py-4 shadow-md transition-transform">
        <h2 class="mb-2 text-lg font-bold">Filtros de búsqueda</h2>
        <!-- Botones para cambiar de formulario -->
        <div class="mb-4 flex space-x-4">
            <!-- @ if (Auth::user()->tipo != 'B') -->
            <button class="rounded bg-cianna-blue px-4 py-2 text-white"
                onclick="toggleForm('formulario-a')">
                <i class="fa-solid fa-user mr-2"></i>Compañeros
            </button>
            <!-- @ elseif (Auth::user()->tipo != 'A') -->
            <button class="rounded bg-cianna-blue px-4 py-2 text-white"
                onclick="toggleForm('formulario-b')">
                <i class="fa-solid fa-bed mr-2"></i>Habitaciones
            </button>
            <!-- @ endif -->
        </div>
        <div class="w-full">
            <!-- @ if (Auth::user()->tipo != 'B') -->
            <div id="formulario-a" class="formulario form hidden">
                <h3 class="font-bold">Compañeros</h3>
                <form id="form-a" action="{{ route('busquedaRoomies') }}" method="GET">
                    <!-- DIV 1 -->
                    <div class="flex items-center space-x-6">
                        <!-- EDAD -->
                        <div class="items-center">
                            <label class="block text-sm font-medium text-gray-700">Edad</label>
                            <div class="flex space-x-2">
                                <div>
                                    <label for="edad_min"
                                        class="block text-xs font-medium text-gray-700">Mínimo</label>
                                    <input id="edad_min" name="edad_min" type="number"
                                        min="18" max="35"
                                        class="mt-1 w-auto rounded-md border border-gray-300 text-sm shadow-sm focus:border-cianna-orange focus:ring-cianna-orange"
                                        value="{{ request('edad_min') }}">
                                </div>
                                <div>
                                    <label for="edad_max"
                                        class="block text-xs font-medium text-gray-700">Máximo</label>
                                    <input id="edad_max" name="edad_max" type="number"
                                        min="18" max="35"
                                        class="mt-1 w-auto rounded-md border border-gray-300 text-sm shadow-sm focus:border-cianna-orange focus:ring-cianna-orange"
                                        value="{{ request('edad_max') }}">
                                </div>
                            </div>
                        </div>
                        <!-- SEXO -->
                        <div class="pt-5">
                            <label for="sexo"
                                class="block text-sm font-medium text-gray-700">Sexo</label>
                            <select name="sexo" id="sexo"
                                class="w-auto rounded-md border border-gray-300 text-sm shadow-sm hover:cursor-pointer focus:border-cianna-orange focus:ring-cianna-orange">
                                <option value="">Cualquiera</option>
                                <option value="Masculino"
                                    {{ request('sexo') == 'Masculino' ? 'selected' : '' }}>
                                    Masculino</option>
                                <option value="Femenino"
                                    {{ request('sexo') == 'Femenino' ? 'selected' : '' }}>
                                    Femenino
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- DIV 2 -->
                    <div class="mt-2 flex items-center space-x-6">
                        <!-- CARRERAS -->
                        @php
                            $carrerasSeleccionadas = request('carreras', []);
                        @endphp

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Carrera</label>
                            <div class="relative">
                                <div id="dropdownCareer"
                                    class="flex w-min cursor-pointer items-center justify-center rounded-md border border-gray-300 bg-white px-2 py-2 text-xs">
                                    <span id="selectedCareers">
                                        {{ empty($carrerasSeleccionadas) ? 'Seleccionar' : count($carrerasSeleccionadas) - 1 . ' seleccionada(s)' }}
                                    </span>
                                    <i id="dpCareerIcon"
                                        class="fa-solid fa-chevron-down ml-2 text-gray-500"></i>
                                </div>
                                <!-- Dropdown Menu -->
                                <div id="dropdownMenu"
                                    class="absolute z-10 mt-2 hidden w-64 rounded border border-gray-300 bg-white shadow-lg">
                                    <div class="px-2 py-2">
                                        <!-- Seleccionar todas -->
                                        <label
                                            class="flex items-center px-2 py-1 text-sm hover:cursor-pointer hover:bg-orange-200">
                                            <input type="checkbox" id="selectAll"
                                                class="mr-2 text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange" />
                                            Todas
                                        </label>
                                        @php
                                            $carreras = [
                                                'ing_alim_biot' =>
                                                    'Ing. en Alimentos y Biotecnología',
                                                'ing_biom' => 'Ing. Biomédica',
                                                'ing_civi' => 'Ing. Civil',
                                                'ing_comp' => 'Ing. en Computación',
                                                'ing_com_elec' =>
                                                    'Ing. en Comunicaciones y Electrónica',
                                                'ing_log_trans' => 'Ing. en Logística y Transporte',
                                                'ing_topo' => 'Ing. en Topografía Geomática',
                                                'ing_foto' => 'Ing. Fotónica',
                                                'ing_indu' => 'Ing. Industrial',
                                                'ing_info' => 'Ing. Informática',
                                                'ing_meca' => 'Ing. Mecánica Eléctrica',
                                                'ing_quim' => 'Ing. Química',
                                                'ing_robo' => 'Ing. Robótica',
                                                'lic_cien_mate' => 'Lic. en Ciencia de Materiales',
                                                'lic_fis' => 'Lic. en Física',
                                                'lic_mate' => 'Lic. en Matemáticas',
                                                'lic_quim' => 'Lic. en Química',
                                                'lic_qfb' => 'Lic. en Químico Farmacéutico Biólogo',
                                            ];
                                        @endphp
                                        @foreach ($carreras as $key => $label)
                                            <label
                                                class="flex items-center px-2 py-1 text-xs hover:cursor-pointer hover:bg-orange-200">
                                                <input type="checkbox" name="carreras[]"
                                                    value="{{ $key }}"
                                                    class="childCheckbox mr-2 text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                                    {{ in_array($key, $carrerasSeleccionadas) ? 'checked' : '' }}>
                                                {{ $label }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- MASCOTAS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Mascotas
                            </label>
                            <div class="flex space-x-2">
                                <label for="mascota_si" class="text-xs hover:cursor-pointer">
                                    <input type="radio" id="mascota_si" name="mascota"
                                        value="si"
                                        class="text-cianna-orange focus:ring-cianna-orange"
                                        {{ request('mascota') == 'si' ? 'checked' : '' }}>
                                    Sí
                                </label>
                                <label for="mascota_no" class="text-xs hover:cursor-pointer">
                                    <input type="radio" id="mascota_no" name="mascota"
                                        value="no"
                                        class="text-cianna-orange focus:ring-cianna-orange"
                                        {{ request('mascota') == 'no' ? 'checked' : '' }}>
                                    No
                                </label>
                                <label for="mascota_cualquiera"
                                    class="text-xs hover:cursor-pointer">
                                    <input type="radio" id="mascota_cualquiera" name="mascota"
                                        value=""
                                        class="text-cianna-orange focus:ring-cianna-orange"
                                        {{ request('mascota') === '' ? 'checked' : '' }}>
                                    Cualquiera
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- DIV 3 -->
                    <div class="mt-2 flex items-center space-x-6">
                        <!-- PADECIMENTOS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Padecimientos médicos
                            </label>
                            <div>
                                <label for="padecimiento_si"
                                    class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" id="padecimiento_si"
                                        name="padecimiento" value="si"
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                        {{ request('padecimiento') == 'si' ? 'checked' : '' }}>
                                    Sí
                                </label>
                                <label for="padecimiento_no"
                                    class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" id="padecimiento_no"
                                        name="padecimiento" value="no"
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                        {{ request('padecimiento') == 'no' ? 'checked' : '' }}>
                                    No
                                </label>
                                <label for="padecimiento_cualquiera"
                                    class="text-xs hover:cursor-pointer">
                                    <input type="radio" id="padecimiento_cualquiera"
                                        name="padecimiento" value=""
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                        {{ request('padecimiento') === '' ? 'checked' : '' }}>
                                    Cualquiera
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- DIV 4 -->
                    <div class="mt-2 flex items-center space-x-6">
                        <!-- ESTILO DE VIDA -->
                        <div>
                            @php
                                $lifestyleSeleccionados = request('lifestyle', []);
                            @endphp
                            <label class="block text-sm font-medium text-gray-700">
                                Estilo de vida
                            </label>
                            <div>
                                <label class="block py-1 text-xs hover:cursor-pointer">
                                    <input type="checkbox" id="allLifestyle"
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                        {{ in_array('d', $lifestyleSeleccionados) && in_array('t', $lifestyleSeleccionados) && in_array('a', $lifestyleSeleccionados) ? 'checked' : '' }}>
                                    Todos
                                </label>
                                <label class="block pb-1 text-xs hover:cursor-pointer">
                                    <input type="checkbox" name="lifestyle[]" value="d"
                                        class="childLifestyle text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                        {{ in_array('d', $lifestyleSeleccionados) ? 'checked' : '' }}>
                                    Divertido
                                </label>
                                <label class="block pb-1 text-xs hover:cursor-pointer">
                                    <input type="checkbox" name="lifestyle[]" value="t"
                                        class="childLifestyle text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                        {{ in_array('t', $lifestyleSeleccionados) ? 'checked' : '' }}>
                                    Tranquilo
                                </label>
                                <label class="block text-xs hover:cursor-pointer">
                                    <input type="checkbox" name="lifestyle[]" value="a"
                                        class="childLifestyle text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange"
                                        {{ in_array('a', $lifestyleSeleccionados) ? 'checked' : '' }}>
                                    Equilibrado
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- BOTÓN PARA ENVIAR -->
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="rounded-lg bg-cianna-blue px-4 py-2 text-white hover:bg-sky-900 focus:outline-none focus:ring-4 focus:ring-sky-400">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>Buscar
                        </button>
                    </div>
                </form>
            </div>
            <!-- @ elseif(Auth::user()->tipo != 'A') -->
            <div id="formulario-b" class="formulario form hidden">
                <h3 class="font-bold">Habitaciones</h3>
                <form id="form-b" action="{{ route('busquedaHabitaciones') }}"method="GET">
                    <!-- DIV 1 -->
                    <div class="items-center">
                        <!-- DOMICILIO -->
                        <label class="block text-sm font-medium text-gray-700">Domicilio</label>
                        <div class="flex items-center space-x-2">
                            <div class="w-full">
                                <label for="calle"
                                    class="block text-xs font-medium text-gray-700">
                                    Calle
                                </label>
                                <input id="calle" name="calle" type="text"
                                    class="mt-1 w-full rounded-md border border-gray-300 text-xs shadow-sm focus:border-cianna-orange focus:ring-cianna-orange"
                                    value="{{ request('calle') }}">
                            </div>
                            <div class="w-[32%]">
                                <label for="num_ext"
                                    class="block text-xs font-medium text-gray-700">
                                    N° ext.
                                </label>
                                <input id="num_ext" name="num_ext" type="number"
                                    class="mt-1 w-full rounded-md border border-gray-300 text-xs shadow-sm focus:border-cianna-orange focus:ring-cianna-orange"
                                    value="{{ request('num_ext') }}">
                            </div>
                            <div class="w-[32%]">
                                <label for="num_int"
                                    class="block text-xs font-medium text-gray-700">
                                    N° int.
                                </label>
                                <input id="num_int" name="num_int" type="number"
                                    class="mt-1 w-full rounded-md border border-gray-300 text-xs shadow-sm focus:border-cianna-orange focus:ring-cianna-orange"
                                    value="{{ request('num_int') }}">
                            </div>
                        </div>
                        <div class="mt-2 flex items-center space-x-2">
                            <div class="w-[60%]">
                                <label for="ciudad"
                                    class="block text-xs font-medium text-gray-700">
                                    Ciudad
                                </label>
                                <select id="ciudad" name="ciudad" class="mt-1 w-full rounded-md border border-gray-300 text-xs shadow-sm focus:border-cianna-orange focus:ring-cianna-orange">
                                    <option value="" {{ request('ciudad') == '' ? 'selected' : '' }}>Cualquiera</option>
                                    <option value="gdl" {{ request('ciudad') == 'gdl' ? 'selected' : '' }}>Guadalajara</option>
                                    <option value="salto" {{ request('ciudad') == 'salto' ? 'selected' : '' }}>El Salto</option>
                                    <option value="tlaj_z" {{ request('ciudad') == 'tlaj_z' ? 'selected' : '' }}>Tlajomulco de Zúñiga</option>
                                    <option value="tlaq" {{ request('ciudad') == 'tlaq' ? 'selected' : '' }}>San Pedro Tlaquepaque</option>
                                    <option value="ton" {{ request('ciudad') == 'ton' ? 'selected' : '' }}>Tonalá</option>
                                    <option value="zap" {{ request('ciudad') == 'zap' ? 'selected' : '' }}>Zapopan</option>
                                </select>
                            </div>
                            <div class="w-[45%]">
                                <label for="colonia"
                                    class="block text-xs font-medium text-gray-700">
                                    Colonia
                                </label>
                                <input id="colonia" name="colonia" type="text"
                                    class="mt-1 w-full rounded-md border border-gray-300 text-xs shadow-sm focus:border-cianna-orange focus:ring-cianna-orange"
                                    value="{{ request('colonia') }}">
                            </div>
                            <div class="w-[25%]">
                                <label for="cod_post"
                                    class="block text-xs font-medium text-gray-700">
                                    C.P.
                                </label>
                                <input id="cod_post" name="cod_post"
                                    class="mt-1 w-full rounded-md border border-gray-300 text-xs shadow-sm focus:border-cianna-orange focus:ring-cianna-orange"
                                    maxlength="5" value="{{ request('cod_post') }}">
                            </div>
                        </div>
                    </div>
                    <!-- DIV 2 -->
                    <div class="mt-2 items-center">
                        <!-- REGLAS -->
                        <label class="block text-sm font-medium text-gray-700">Reglas</label>
                        <div>
                            <label class="block text-xs font-medium text-gray-700">
                                Mascotas
                            </label>
                            <div>
                                <label class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" name="mascotas" value="si" {{ request('mascotas') == 'si' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    Sí
                                </label>
                                <label class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" name="mascotas" value="no" {{ request('mascotas') == 'no' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    No
                                </label>
                                <label class="text-xs hover:cursor-pointer">
                                    <input type="radio" name="mascotas" value="" {{ request('mascotas') == '' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    Cualquiera
                                </label>
                            </div>
                        </div>
                        <div class="mt-1 items-center">
                            <label class="block text-xs font-medium text-gray-700">
                                Visitas
                            </label>
                            <div>
                                <label class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" name="visitas" value="si" {{ request('visitas') == 'si' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    Sí
                                </label>
                                <label class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" name="visitas" value="no" {{ request('visitas') == 'no' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    No
                                </label>
                                <label class="text-xs hover:cursor-pointer">
                                    <input type="radio" name="visitas" value="" {{ request('visitas') == '' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    Cualquiera
                                </label>
                            </div>
                        </div>
                        <div class="mt-1 items-center">
                            <label class="block text-xs font-medium text-gray-700">
                                Limpieza rigurosa
                            </label>
                            <div>
                                <label class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" name="limpieza" value="si" {{ request('limpieza') == 'si' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    Sí
                                </label>
                                <label class="mr-2 text-xs hover:cursor-pointer">
                                    <input type="radio" name="limpieza" value="no" {{ request('limpieza') == 'no' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    No
                                </label>
                                <label class="text-xs hover:cursor-pointer">
                                    <input type="radio" name="limpieza" value="" {{ request('limpieza') == '' ? 'checked' : '' }}
                                        class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                    Cualquiera
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- DIV 3 -->
                    <div class="mt-2 items-center">
                        <!-- MUEBLES -->
                        <label class="block text-sm font-medium text-gray-700">
                            Incluye muebles
                        </label>
                        <div>
                            <label class="mr-2 text-xs hover:cursor-pointer">
                                <input type="radio" name="muebles" value="si" {{ request('muebles') == 'si' ? 'checked' : '' }}
                                    class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                Sí
                            </label>
                            <label class="mr-2 text-xs hover:cursor-pointer">
                                <input type="radio" name="muebles" value="no" {{ request('muebles') == 'no' ? 'checked' : '' }}
                                    class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                No
                            </label>
                            <label class="text-xs hover:cursor-pointer">
                                <input type="radio" name="muebles" value="" {{ request('muebles') == '' ? 'checked' : '' }}
                                    class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                Cualquiera
                            </label>
                        </div>
                    </div>
                    <!-- DIV 4-->
                    <div class="mt-2 items-center">
                        <!-- SERVCIOS -->
                        <label class="block text-sm font-medium text-gray-700">
                            Incluye servicios
                        </label>
                        <div>
                            <label class="mr-2 text-xs hover:cursor-pointer">
                                <input type="radio" name="servicios" value="si" {{ request('servicios') == 'si' ? 'checked' : '' }}
                                    class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                Sí
                            </label>
                            <label class="mr-2 text-xs hover:cursor-pointer">
                                <input type="radio" name="servicios" value="no" {{ request('servicios') == 'no' ? 'checked' : '' }}
                                    class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                No
                            </label>
                            <label class="text-xs hover:cursor-pointer">
                                <input type="radio" name="servicios" value="" {{ request('servicios') == '' ? 'checked' : '' }}
                                    class="text-cianna-orange hover:cursor-pointer focus:ring-cianna-orange">
                                Cualquiera
                            </label>
                        </div>
                    </div>
                    <!-- DIV 5-->
                    <div class="mt-2 items-center">
                        <!-- PRECIO -->
                        <label class="block text-sm font-medium text-gray-700">Precio</label>
                        <div>
                            <!-- Valores dinámicos -->
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Min: $<span id="minOutput"
                                        class="font-bold text-cianna-orange">0</span>
                                </span>
                                <span>Max: $<span id="maxOutput"
                                        class="font-bold text-cianna-orange">10000</span>
                                </span>
                            </div>
                            <!-- Slider de rango -->
                            <div class="range-slider mt-4">
                                <div class="range-progress" id="rangeProgress"></div>
                                <input type="range" id="minSlider" min="0"
                                    max="10000" step="10" value="0">
                                <input type="range" id="maxSlider" min="0"
                                    max="10000" step="10" value="10000">
                            </div>
                            <!-- Campos ocultos -->
                            <input type="hidden" name="minPrice" id="hiddenMinPrice"
                                value="{{ request('minPrice', 0) }}">
                            <input type="hidden" name="maxPrice" id="hiddenMaxPrice"
                                value="{{ request('minPrice', 10000) }}">
                        </div>
                    </div>
                    <!-- BOTÓN PARA ENVIAR -->
                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="rounded-lg bg-cianna-blue px-4 py-2 text-white hover:bg-sky-900 focus:outline-none focus:ring-4 focus:ring-sky-400">
                            <i class="fa-solid fa-magnifying-glass mr-2"></i>Buscar
                        </button>
                    </div>
                </form>
            </div>
            <!-- @ endif -->
        </div>
    </div>
</div>

<!-- OCULTAR/MOSTRAR DIV FLOTANTE CON FILTROS -->
<script>
    function toggleSearchPreferences() {
        const searchPreferences = document.getElementById('searchPreferences');
        const preferencesButton = document.getElementById('preferencesButton');

        // Mostrar el div flotante
        if (searchPreferences.classList.contains('hidden')) {
            const buttonRect = preferencesButton.getBoundingClientRect();
            searchPreferences.style.top =
                `${buttonRect.bottom + window.scrollY}px`;
            searchPreferences.style.left = `${buttonRect.left}px`;
            searchPreferences.classList.remove('hidden');
            setTimeout(() => {
                searchPreferences.classList.add('translate-y-0',
                    'opacity-100');
                searchPreferences.classList.remove('-translate-y-4',
                    'opacity-0');
            }, 10);
        } else {
            // Ocultar el div flotante
            searchPreferences.classList.add('-translate-y-4', 'opacity-0');
            searchPreferences.classList.remove('translate-y-0', 'opacity-100');
            setTimeout(() => {
                searchPreferences.classList.add('hidden');
            }, 300);
        }
    }

    // Función para cerrar el div flotante si se hace clic fuera de él
    document.addEventListener('click', function(event) {
        const searchPreferences = document.getElementById(
            'searchPreferences');
        const preferencesButton = document.getElementById(
            'preferencesButton');

        // Verificar si el clic fue fuera del div flotante y del botón
        if (!searchPreferences.contains(event.target) && !
            preferencesButton
            .contains(event
                .target)) {
            // Solo cerrar si el div flotante está visible
            if (!searchPreferences.classList.contains('hidden')) {
                toggleSearchPreferences();
            }
        }
    });
</script>

<!-- ESTILO PARA EL DIV DE LOS FILTROS -->
<style>
    #searchPreferences {
        position: absolute;
        transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
        transform: translateY(-1rem);
        opacity: 0;
    }

    #searchPreferences.opacity-100 {
        opacity: 1;
    }
</style>

<!-- OCULTAR/MOSTRAR DIV FLOTANTE CON CARRERAS-->
<script>
    // DROPDOWN DE CARRERAS
    document.addEventListener('DOMContentLoaded', () => {
        const dropDownIcon = document.getElementById('dpCareerIcon');
        const dropdownButton = document.getElementById(
            'dropdownCareer');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Evento para mostrar y ocultar el dropdown
        dropdownButton.addEventListener('click', function(e) {
            e
                .stopPropagation(); // Evitar que el evento se propague al `window`

            // Alternar las clases del ícono y el menú
            dropDownIcon.classList.toggle('fa-chevron-down');
            dropDownIcon.classList.toggle('fa-chevron-up');
            dropdownMenu.classList.toggle('hidden');

            this.classList.toggle('border-cianna-orange');
            this.classList.toggle('border-2');
            this.classList.toggle('border-gray-300');
        });

        // Detener la propagación del evento de clic dentro del menú
        dropdownMenu.addEventListener('click', function(e) {
            e
                .stopPropagation(); // Prevenir que el evento cierre el dropdown
        });

        // Ocultar el dropdown al hacer clic fuera
        window.addEventListener('click', function() {
            if (!dropdownMenu.classList.contains('hidden')) {
                dropDownIcon.classList.add('fa-chevron-down');
                dropDownIcon.classList.remove('fa-chevron-up');
                dropdownMenu.classList.add('hidden');

                dropdownButton.classList.remove(
                    'border-cianna-orange');
                dropdownButton.classList.remove('border-2');
                dropdownButton.classList.add('border-gray-300');
            }
        });
    });
</script>

<script>
    // Obtener elementos
    const selectAllCheckbox = document.getElementById('selectAll');
    const childCheckboxes = document.querySelectorAll('.childCheckbox');
    const form_a = document.getElementById(
        'form-a'); // Selecciona el formulario que contiene los checkboxes
    const hiddenInput = document.querySelector(
        'input[name="carreras"]'); // Input oculto para "carreras"
    const selectedText = document.getElementById(
        "selectedCareers"); // Texto que muestra la cantidad de seleccionados

    // Función para actualizar el texto de selección
    function updateSelectedText() {
        const selected = [...childCheckboxes].filter(chk => chk.checked).length;
        selectedText.textContent = selected > 0 ? `${selected} seleccionadas` :
            "Seleccionar";
    }

    // Evento para seleccionar/deseleccionar todos los checkboxes secundarios
    selectAllCheckbox.addEventListener('change', function() {
        childCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateSelectedText(); // Actualizar el texto
    });

    // Evento para actualizar el estado del checkbox "Seleccionar todo"
    childCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Si al menos uno no está marcado, desmarcar "Seleccionar todo"
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else {
                // Si todos están marcados, marcar "Seleccionar todo"
                const allChecked = Array.from(childCheckboxes)
                    .every(cb =>
                        cb
                        .checked);
                selectAllCheckbox.checked = allChecked;
            }
            updateSelectedText(); // Actualizar el texto
        });
    });

    // Evento antes de enviar el formulario
    form_a.addEventListener('submit', function(e) {
        // Si "Seleccionar todo" está marcado
        if (selectAllCheckbox.checked) {
            // Desmarcar todos los checkboxes secundarios antes de enviar el formulario
            childCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    });

    // Llamar a la función para actualizar el texto inicialmente
    updateSelectedText();
</script>

<!-- COMPORTAMIENTO DE LAS CASILLAS PARA LIFESTYLE -->
<script>
    // Obtener los elementos
    const allLifestyle = document.getElementById('allLifestyle');
    const otherLifestyleCheckboxes = document.querySelectorAll(
        'input[name="lifestyle[]"]:not(#allLifestyle)');

    // Evento al marcar "Cualquiera"
    allLifestyle.addEventListener('change', function() {
        if (this.checked) {
            // Desmarcar todas las otras casillas
            otherLifestyleCheckboxes.forEach(checkbox => checkbox
                .checked =
                false);
        }
    });

    // Evento al marcar cualquier otra casilla
    otherLifestyleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // Desmarcar la casilla "Cualquiera"
                allLifestyle.checked = false;
            }
        });
    });
</script>



<!-- VERIFICAR DATOS EN CONSOLA ENVIADOS DESDE FORMULARIO A -->
<!-- <script>
    document.getElementById('form-a').addEventListener('submit', function(
        event) {
        // Evitar el envío del formulario (solo para depuración)
        event.preventDefault();

        // Obtener los datos del formulario
        const formData = new FormData(this);

        // Convertir los datos en un objeto para que sea más fácil de leer
        const formObject = {};
        formData.forEach((value, key) => {
            if (formObject[key]) {
                // Si ya existe una clave con ese nombre, hacer un arreglo para almacenar múltiples valores
                if (Array.isArray(formObject[key])) {
                    formObject[key].push(value);
                } else {
                    formObject[key] = [formObject[key], value];
                }
            } else {
                formObject[key] = value;
            }
        });

        // Mostrar los datos del formulario en la consola
        console.log(formObject);

        // Si deseas continuar con el envío del formulario después de revisar los datos, puedes descomentar la siguiente línea:
        // this.submit();
    });
</script> -->

<!-- VERIFICAR DATOS EN CONSOLA ENVIADOS DESDE FORMULARIO B -->
<!-- <script>
    document.getElementById('form-b').addEventListener('submit', function(
        event) {
        // Evitar el envío del formulario (solo para depuración)
        event.preventDefault();

        // Obtener los datos del formulario
        const formData = new FormData(this);

        // Convertir los datos en un objeto para que sea más fácil de leer
        const formObject = {};
        formData.forEach((value, key) => {
            if (formObject[key]) {
                // Si ya existe una clave con ese nombre, hacer un arreglo para almacenar múltiples valores
                if (Array.isArray(formObject[key])) {
                    formObject[key].push(value);
                } else {
                    formObject[key] = [formObject[key], value];
                }
            } else {
                formObject[key] = value;
            }
        });

        // Mostrar los datos del formulario en la consola
        console.log(formObject);

        // Si deseas continuar con el envío del formulario después de revisar los datos, puedes descomentar la siguiente línea:
        // this.submit();
    });
</script> -->

<script>
    function toggleForm(formId) {
        const forms = document.querySelectorAll('.form');
        const formToToggle = document.getElementById(formId);

        // Verificar si el formulario ya está visible
        if (formToToggle.classList.contains('hidden')) {
            // Ocultar todos los formularios
            forms.forEach(form => form.classList.add('hidden'));
            // Mostrar el formulario seleccionado
            formToToggle.classList.remove('hidden');
        } else {
            // Si el formulario ya está visible, ocultarlo
            formToToggle.classList.add('hidden');
        }
    }

    // Mostrar por defecto el Formulario A al cargar
    //toggleForm('formulario-a');
</script>

<style>
    /* Estilo personalizado para el rango doble */
    .range-slider {
        position: relative;
        width: 100%;
        height: 2px;
        background-color: #e5e7eb;
        /* bg-gray-300 */
        border-radius: 5px;
    }

    .range-slider input[type="range"] {
        position: absolute;
        width: 100%;
        height: 2px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
    }

    .range-slider input[type="range"]::-webkit-slider-thumb {
        position: relative;
        z-index: 2;
        pointer-events: all;
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        background-color: #D47814;
        border-radius: 50%;
        cursor: pointer;
    }

    .range-slider .range-progress {
        position: absolute;
        height: 100%;
        background-color: #D47814;
        z-index: 1;
        border-radius: 5px;
    }
</style>

<!-- SCRIPT PARA MANIPULAR EL SLIDER DE PRECIO -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const minSlider = document.getElementById("minSlider");
        const maxSlider = document.getElementById("maxSlider");
        const minOutput = document.getElementById("minOutput");
        const maxOutput = document.getElementById("maxOutput");
        const rangeProgress = document.getElementById("rangeProgress");
        const hiddenMinPrice = document.getElementById(
            "hiddenMinPrice");
        const hiddenMaxPrice = document.getElementById(
            "hiddenMaxPrice");

        // Función para actualizar el rango visual y sincronizar con los inputs ocultos
        const updateRange = () => {
            const minValue = parseInt(minSlider.value);
            const maxValue = parseInt(maxSlider.value);

            // Evitar que los sliders se crucen
            if (minValue >= maxValue) {
                minSlider.value = maxValue - 10;
            }
            if (maxValue <= minValue) {
                maxSlider.value = minValue + 10;
            }

            // Actualizar los valores mostrados
            minOutput.textContent = minSlider.value;
            maxOutput.textContent = maxSlider.value;

            // Actualizar la barra de progreso
            const rangeWidth = maxSlider.max - maxSlider.min;
            const minPosition = ((minSlider.value - minSlider.min) /
                rangeWidth) * 100;
            const maxPosition = ((maxSlider.value - maxSlider.min) /
                rangeWidth) * 100;

            rangeProgress.style.left = `${minPosition}%`;
            rangeProgress.style.right = `${100 - maxPosition}%`;

            // Sincronizar los valores con los inputs ocultos
            hiddenMinPrice.value = minSlider.value;
            hiddenMaxPrice.value = maxSlider.value;
        };

        // Actualizar rango al mover los sliders
        minSlider.addEventListener("input", updateRange);
        maxSlider.addEventListener("input", updateRange);

        // Inicializar el rango
        updateRange();
    });
</script>
