<div>
    <div id="preferencesButton" class="flex cursor-pointer" 
        onclick="toggleSearchPreferences()">
        <div class="flex justify-center items-center bg-gray-400 rounded-md rounded-r-none">
            <i class="fa-solid fa-magnifying-glass px-2"></i>
        </div>
        <div class="flex items-center bg-gray-300 px-4 py-2 rounded-md rounded-l-none">
            <i class="fa-solid fa-gear mr-2"></i>Preferencias
        </div>
    </div>
    <div id="searchPreferences" class="absolute mt-2 w-96 bg-white border-cianna-gray 
        border-[1px] shadow-md py-4 px-6 rounded-md hidden z-50 transition-transform">
        <h2 class="text-lg font-bold mb-2">Filtros de búsqueda</h2>
        <!-- Botones para cambiar de formulario -->
        <div class="flex space-x-4 mb-4">
            <!-- @ if (Auth::user()->tipo != 'B') -->
            <button 
                class="px-4 py-2 bg-cianna-blue text-white rounded" 
                onclick="toggleForm('formulario-a')">
                <i class="fa-solid fa-user mr-2"></i>Compañeros
            </button>
            <!-- @ elseif (Auth::user()->tipo != 'A') -->
            <button 
                class="px-4 py-2 bg-cianna-blue text-white rounded" 
                onclick="toggleForm('formulario-b')">
                <i class="fa-solid fa-bed mr-2"></i>Habitaciones
            </button>
            <!-- @ endif -->
        </div>
        <div class="w-full">
            <!-- @ if (Auth::user()->tipo != 'B') -->
                <div id="formulario-a" class="formulario form hidden">
                    <h3 class="font-bold">Compañeros</h3>
                    <form id="form-a" action="" method="">
                        <!-- DIV 1 -->
                        <div class="flex items-center space-x-6">
                            <!-- EDAD -->
                            <div class="items-center">
                                <label class="block text-sm font-medium 
                                text-gray-700">Edad</label>
                                <div class="flex space-x-2">
                                    <div>
                                        <label for="edad_min" class="block text-xs font-medium 
                                        text-gray-700">Mínimo</label>
                                        <input id="edad_min" name="edad_min" type="number" min="18" 
                                        max="35"class="mt-1 text-sm w-auto border 
                                        border-gray-300 rounded-md shadow-sm 
                                        focus:ring-cianna-orange focus:border-cianna-orange">
                                    </div>
                                    <div>
                                        <label for="edad_max" class="block text-xs font-medium 
                                        text-gray-700">Máximo</label>
                                        <input id="edad_max" name="edad_max" type="number" 
                                        min="18" max="35" class="mt-1 text-sm w-auto border 
                                        border-gray-300 rounded-md shadow-sm 
                                        focus:ring-cianna-orange focus:border-cianna-orange">
                                    </div>
                                </div>
                            </div>
                            <!-- SEXO -->
                            <div class="pt-5">
                                <label for="sexo" class="block text-sm font-medium 
                                text-gray-700">Sexo</label>
                                <select name="sexo" id="sexo" class="text-sm w-auto border 
                                    border-gray-300 rounded-md shadow.sm focus:ring-cianna-orange 
                                    focus:border-cianna-orange hover:cursor-pointer">
                                    <option value="">Cualquiera</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <!-- DIV 2 -->
                        <div class="flex items-center mt-2 space-x-6">
                            <!-- CARRERAS -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Carrera
                                </label>
                                <div class="relative">
                                    <div id="dropdownCareer" class="flex text-xs py-2 px-2 
                                        rounded-md items-center cursor-pointer w-min bg-white 
                                        border border-gray-300">
                                        Seleccionar
                                        <i id="dpCareerIcon" 
                                        class="fa-solid fa-chevron-down ml-2 text-gray-500"></i>
                                    </div>
                                    <!-- Dropdown Menu -->
                                    <div id="dropdownMenu" class="hidden absolute mt-2 w-64 bg-white
                                        border border-gray-300 rounded shadow-lg z-10">
                                        <div class="px-2 py-2">
                                            <!-- Campo oculto para enviar vacío si no hay selección -->
                                            <input type="hidden" name="carreras[]" value="">
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-sm">
                                                <input type="checkbox" id="selectAll" 
                                                class="mr-2 text-cianna-orange hover:cursor-pointer
                                                focus:ring-cianna-orange" />
                                                Todas
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_alim_biot" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange">
                                                Ing. en Alimentos y Biotecnología
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_biom" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Biomédica
                                            </label>
                                            <label class="px-2 py-1 flex items-center
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_civi" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Civil
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_comp" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. en Computación
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_com_elec" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. en Comunicaciones y Electrónica
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_log_trans" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. en Logística y Transporte
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_topo" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. en Topografía Geomática
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_foto" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Fotónica
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_indu" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Industrial
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_info" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Informática
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_meca" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Mecánica Eléctrica
                                            </label>
                                            <label class="px-2 py-1 flex items-center
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_quim" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Química
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="ing_robo" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Ing. Robótica
                                            </label>
                                            <label class="px-2 py-1 flex items-center
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="lic_cien_mate" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Lic. en Ciencia de Materiales
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="lic_fis" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Lic. en Física
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="lic_mate" 
                                                class="childCheckbox mr-2 text-cianna-orange
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Lic. en Matemáticas
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="lic_quim" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Lic. en Química
                                            </label>
                                            <label class="px-2 py-1 flex items-center 
                                                hover:cursor-pointer hover:bg-orange-200 text-xs">
                                                <input type="checkbox" name="carreras[]" 
                                                value="lic_qfb" 
                                                class="childCheckbox mr-2 text-cianna-orange 
                                                hover:cursor-pointer focus:ring-cianna-orange"> 
                                                Lic. en Químico Farmacéutico Biólogo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MASCOTAS -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Mascotas
                                </label>
                                <div>
                                    <label class="text-xs mr-2 hover:cursor-pointer">
                                        <input type="radio" name="mascota" value="si" 
                                        class="text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange"> 
                                        Sí
                                    </label>
                                    <label class="text-xs mr-2 hover:cursor-pointer">
                                        <input type="radio" name="mascota" value="no"
                                        class="text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange">
                                        No
                                    </label>
                                    <label class="text-xs hover:cursor-pointer">
                                        <input type="radio" name="mascota" value=""
                                        class="text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange" checked>
                                        Cualquiera
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- DIV 3 -->
                        <div class="flex items-center mt-2 space-x-6">
                            <!-- PADECIMENTOS -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Padecimientos médicos
                                </label>
                                <div>
                                    <label class="text-xs mr-2 hover:cursor-pointer">
                                        <input type="radio" name="padecimiento" value="si" 
                                        class="text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange"> 
                                        Sí
                                    </label>
                                    <label class="text-xs mr-2 hover:cursor-pointer">
                                        <input type="radio" name="padecimiento" value="no"
                                        class="text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange">
                                        No
                                    </label>
                                    <label class="text-xs hover:cursor-pointer">
                                        <input type="radio" name="padecimiento" value=""
                                        class="text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange" checked>
                                        Cualquiera
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- DIV 4 -->
                        <div class="flex items-center mt-2 space-x-6">
                            <!-- ESTILO DE VIDA -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Estilo de vida
                                </label>
                                <div>
                                    <!-- Campo oculto para enviar vacío si no hay selección -->
                                    <input type="hidden" id="hiddenLifestyle" name="lifestyle[]" value="">
                                    <label class="text-xs py-1 hover:cursor-pointer block">
                                        <input type="checkbox" id="allLifestyle"
                                        class="childLifestyle text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange" checked>
                                        Cualquiera
                                    </label>
                                    <label class="text-xs pb-1 hover:cursor-pointer block">
                                        <input type="checkbox" name="lifestyle[]" value="d" 
                                        class="childLifestyle text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange"> 
                                        Divertido
                                    </label>
                                    <label class="text-xs pb-1 hover:cursor-pointer block">
                                        <input type="checkbox" name="lifestyle[]" value="t"
                                        class="childLifestyle text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange">
                                        Tranquilo
                                    </label>
                                    <label class="text-xs hover:cursor-pointer block">
                                        <input type="checkbox" name="lifestyle[]" value="a"
                                        class="childLifestyle text-cianna-orange hover:cursor-pointer
                                        focus:ring-cianna-orange">
                                        Equilibrado
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- BOTÓN PARA ENVIAR -->
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-cianna-blue text-white rounded-lg 
                                hover:bg-sky-900 focus:ring-4 focus:outline-none focus:ring-sky-400">
                                <i class="fa-solid fa-magnifying-glass mr-2"></i>Buscar
                            </button>
                        </div>
                    </form>
                </div>
            <!-- @ elseif(Auth::user()->tipo != 'A') -->
                <div id="formulario-b" class="formulario form hidden">
                    <h3 class="font-bold">Habitaciones</h3>
                    <form id="form-b" action="" method="">
                        
                        <label for="category" class="block text-sm font-medium text-gray-700">
                            Categoría
                        </label>
                        <select id="category" name="category" class="mt-1 block w-full border 
                            border-gray-300 rounded-md shadow-sm focus:ring-cianna-orange 
                            focus:border-cianna-orange sm:text-sm">
                            <option value="">Seleccione una categoría</option>
                            <option value="option1">Opción 1</option>
                            <option value="option2">Opción 2</option>
                        </select>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Opciones adicionales
                            </label>
                            <div class="flex items-start mt-2">
                                <input type="checkbox" id="option1" name="option1" 
                                class="h-4 w-4 text-cianna-orange border-gray-300 rounded">
                                <label for="option1" class="ml-2 text-sm text-gray-700">Opción 1</label>
                            </div>
                            <div class="flex items-start mt-2">
                                <input type="checkbox" id="option2" name="option2" class="h-4 w-4 text-cianna-orange border-gray-300 rounded">
                                <label for="option2" class="ml-2 text-sm text-gray-700">Opción 2</label>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-cianna-blue text-white rounded-lg 
                                hover:bg-sky-900 focus:ring-4 focus:outline-none focus:ring-sky-400">
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
            searchPreferences.style.top = `${buttonRect.bottom + window.scrollY}px`;
            searchPreferences.style.left = `${buttonRect.left}px`;
            searchPreferences.classList.remove('hidden');
            setTimeout(() => {
                searchPreferences.classList.add('translate-y-0', 'opacity-100');
                searchPreferences.classList.remove('-translate-y-4', 'opacity-0');
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
        const searchPreferences = document.getElementById('searchPreferences');
        const preferencesButton = document.getElementById('preferencesButton');
        
        // Verificar si el clic fue fuera del div flotante y del botón
        if (!searchPreferences.contains(event.target) && !preferencesButton.contains(event.target)) {
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
        const dropdownButton = document.getElementById('dropdownCareer');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Evento para mostrar y ocultar el dropdown
        dropdownButton.addEventListener('click', function (e) {
            e.stopPropagation(); // Evitar que el evento se propague al `window`

            // Alternar las clases del ícono y el menú
            dropDownIcon.classList.toggle('fa-chevron-down');
            dropDownIcon.classList.toggle('fa-chevron-up');
            dropdownMenu.classList.toggle('hidden');

            this.classList.toggle('border-cianna-orange');
            this.classList.toggle('border-2');
            this.classList.toggle('border-gray-300');
        });

        // Detener la propagación del evento de clic dentro del menú
        dropdownMenu.addEventListener('click', function (e) {
            e.stopPropagation(); // Prevenir que el evento cierre el dropdown
        });

        // Ocultar el dropdown al hacer clic fuera
        window.addEventListener('click', function () {
            if (!dropdownMenu.classList.contains('hidden')) {
                dropDownIcon.classList.add('fa-chevron-down');
                dropDownIcon.classList.remove('fa-chevron-up');
                dropdownMenu.classList.add('hidden');
                
                dropdownButton.classList.remove('border-cianna-orange');
                dropdownButton.classList.remove('border-2');
                dropdownButton.classList.add('border-gray-300');
            }
        });
    });
</script>

<!-- SELECCION DE TODAS LAS CASILLAS EN CARRERAS -->
<script>
    // Obtener elementos
    const selectAllCheckbox = document.getElementById('selectAll');
    const childCheckboxes = document.querySelectorAll('.childCheckbox');
    const form = document.getElementById('form-a'); // Selecciona el formulario que contiene los checkboxes
    const hiddenInput = document.querySelector('input[name="carreras"]'); // Input oculto para "carreras"

    // Evento para seleccionar/deseleccionar todos los checkboxes secundarios
    selectAllCheckbox.addEventListener('change', function () {
        childCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Evento para actualizar el estado del checkbox "Seleccionar todo"
    childCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            // Si al menos uno no está marcado, desmarcar "Seleccionar todo"
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else {
                // Si todos están marcados, marcar "Seleccionar todo"
                const allChecked = Array.from(childCheckboxes).every(cb => cb.checked);
                selectAllCheckbox.checked = allChecked;
            }
        });
    });

    // Evento antes de enviar el formulario
    form.addEventListener('submit', function (e) {
        // Si "Seleccionar todo" está marcado
        if (selectAllCheckbox.checked) {
            // Desmarcar todos los checkboxes secundarios antes de enviar el formulario
            childCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    });
</script>

<!-- COMPORTAMIENTO DE LAS CASILLAS PARA LIFESTYLE -->
<script>
    // Obtener los elementos
    const allLifestyle = document.getElementById('allLifestyle');
    const otherLifestyleCheckboxes = document.querySelectorAll('input[name="lifestyle[]"]:not(#allLifestyle)');

    // Evento al marcar "Cualquiera"
    allLifestyle.addEventListener('change', function () {
        if (this.checked) {
            // Desmarcar todas las otras casillas
            otherLifestyleCheckboxes.forEach(checkbox => checkbox.checked = false);
        }
    });

    // Evento al marcar cualquier otra casilla
    otherLifestyleCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                // Desmarcar la casilla "Cualquiera"
                allLifestyle.checked = false;
            }
        });
    });
</script>



<!-- VERIFICAR DATOS EN CONSOLA ENVIADOS DESDE FORMULARIO A -->
<script>
    document.getElementById('form-a').addEventListener('submit', function(event) {
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
</script>

<!-- VERIFICAR DATOS EN CONSOLA ENVIADOS DESDE FORMULARIO B -->
<script>
    document.getElementById('form-b').addEventListener('submit', function(event) {
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
</script>

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
