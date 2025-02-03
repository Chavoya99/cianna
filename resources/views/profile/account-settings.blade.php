<!-- resources/views/profile/account-settings.blade.php -->
@props(['defaultImage' => asset('img/avatar-default-svgrepo-com.png')])
@section('title') {{ 'Configuración de tu cuenta' }} @endsection
<x-home-layout>
    <x-slot name="logo">
        <x-authentication-card-logo/>
    </x-slot>
    <!--MENSAJES DE ERROR -->
    <x-validation-errors/>
    
    <div class="flex justify-center w-full">
        
        <!-- FORMULARIO -->
        <form class="w-full" id="configForm" action="{{route('actualizar_cuenta')}}" method="POST" 
            enctype="multipart/form-data">
            @csrf
            <!-- TÍTULO -->
            <div class="relative mt-8 ml-20 w-4/5">
                    <h1 class="text-cianna-orange text-5xl">Configuración de la cuenta</h1>
                </div>
                
                <!-- CONTENEDOR HORIZONTAL 1 -->
                <div class="flex w-full mt-8">
                    <!-- CONTENEDOR DESCRIPCIÓN -->
                    <div class="relative px-20 w-[57%]">
                        <x-custom-label for="desc">Cuéntanos sobre ti</x-custom-label>
                        <x-about-you :usuario="$usuario"></x-about-you>
                    </div>
                    <!-- CONTENEDOR SUP/DER FOTO DE PERFIL -->
                    <div class="px-24 w-[43%]">
                        
                        <div class="flex flex-col items-center py-3">
                            <div class="flex flex-col items-center block w-full">
                                <div id="imageContainer" class="inline-block h-40 w-40 overflow-hidden 
                                    rounded-md bg-gray-100 mb-2">
                                    <?php
                                        $imagen = Auth::user()->archivos()->where('archivo_type', 'img_perf')->get();
                                    ?>
                                    <img id="preview" class="h-full w-full object-cover 
                                    border border-cianna-gray rounded-lg" 
                                    src="{{asset('storage/'. $imagen[0]->ruta_archivo)}}" 
                                    alt="Imagen previa" />
                                </div>
                                <x-custom-label for="img_perf">Cambiar foto de perfil</x-custom-label>
                                <label class="text-xs mb-4 text-center text-gray-600">
                                    Para que los demás visualicen mejor tu foto de perfil
                                    recomendamos subir una foto con el mismo ancho y largo.
                                    <br>Ej. 1000x1000
                                </label>
                                <input id="img_perf" name="img_perf" type="file" 
                                accept=".png,.jpg,.jpeg" class="block w-full file:bg-cianna-blue 
                                file:text-white file:cursor-pointer text-sm rounded-md cursor-pointer 
                                bg-cianna-gray border border-cianna-gray focus:border-cianna-orange 
                                focus:outline-none focus:ring-1 focus:ring-cianna-orange" 
                                onchange="previewImage(this)">
                            </div>
                            <label for="img_perf">(Máx. 4 MB)</label>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 1 -->

                <!-- CONTENEDOR HORIZONTAL 2 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ MASCOTAS -->
                    <div class="relative px-20 w-[57%]">
                        <x-has-pets :usuario="$usuario"></x-has-pets>
                    </div>
                    <!-- CONTENEDOR DER EDAD Y SEXO-->
                    <div class="px-24 w-[43%]" >
                        <x-age-sex :usuario="$usuario"></x-age-sex>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 2 -->

                <!-- CONTENEDOR HORIZONTAL 3 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ PADECIMIENTOS -->
                    <div class="relative px-20 w-[57%]">
                        <x-medical-conditions :usuario="$usuario"></x-medical-conditions>
                    </div>
                    <!-- CONTENEDOR DEL CODIGO-->
                    <div class="px-24 w-[43%]">
                        <x-custom-label>Código de estudiante</x-custom-label>
                        <?php 
                            $value = null;
                            if(old('codigo')){
                                $value = old('codigo');
                            }else if(isset($usuario)){
                                $value = $usuario->codigo;
                            }
                        
                        ?>
                        <x-custom-input id="codigo" name="codigo" 
                        class="block mt-1 w-full h-8 text-sm" type="text" minlength="9" maxlength="9" 
                        pattern="[0-9]{9}" required autocomplete="codigo" 
                        placeholder="El mismo con el que ingresas a SIIAU" value="{{$value}}"/>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 3 -->

                <!-- CONTENEDOR HORIZONTAL 4 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ LIFESTYLE -->
                    <div class="relative px-20 w-[57%]">
                        <x-lifestyle :usuario="$usuario"></x-lifestyle>
                    </div>
                    <!-- CONTENEDOR DER CARRERA -->
                    <div class="px-24 w-[43%]">
                        <x-career :usuario="$usuario"></x-career>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 4 -->

                <!-- CONTENEDOR HORIZONTAL 5 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ  -->
                    <div class="relative px-20 w-[57%]"></div>
                    <!-- CONTENEDOR DER KARDEX -->
                    <div class="px-24 w-[43%]">
                        <x-custom-label for="kardex">Actualizar Kardex</x-custom-label>
                        <div class="flex flex-col items-center">
                            <div class="mt-1 flex">
                                <input id="kardex" name="kardex" type="file" accept="application/pdf" 
                                class="block w-full file:bg-cianna-blue file:text-white 
                                file:cursor-pointer text-sm rounded-md cursor-pointer bg-cianna-gray 
                                border border-cianna-gray focus:border-cianna-orange focus:outline-none 
                                focus:ring-1 focus:ring-cianna-orange">
                            </div>
                            <label for="kardex">(Máx. 4 MB)</label>
                        </div>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 5 -->
                
                <!-- CONTENEDOR HORIZONTAL 6 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ  -->
                    <div class="relative px-20 w-[57%]">
                        <!-- CONTENEDOR HORIZONTAL BOTÓN REGRESAR -->
                        <div>
                            <button class=" bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4
                                rounded focus:outline-none focus:shadow-outline" 
                                onclick="window.history.back()">
                                <i class="fa-solid fa-left-long mr-2"></i>Regresar
                            </button>
                        </div>
                    </div>
                    <!-- CONTENEDOR DER BOTÓN ACEPTAR -->
                    <div class="px-24 w-[43%]">
                        <button class="block w-full bg-cianna-blue hover:bg-sky-900 text-white 
                            font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                            type="submit">
                            <i class="fa-solid fa-floppy-disk mr-2"></i>Guardar
                        </button>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 6 -->
        </form>
    </div>
</x-home-layout>

<!-- SCRIPTS -->
<script>
    // PARA CONTAR LOS CARACTERES EN LA DESCRIPCION
    document.addEventListener('DOMContentLoaded', (event) => {
        const textarea = document.getElementById('desc');
        const charCount = document.getElementById('char-count');
        const maxLength = textarea.getAttribute('maxlength');
        
        charCount.textContent = maxLength - textarea.value.length;

        textarea.addEventListener('input', () => {
            const remaining = maxLength - textarea.value.length;
            charCount.textContent = remaining;
        });
    });
    ///////////////////////////////

    // PARA MOSTRAR CAMPO DE NÚMERO DE MASCOTAS
    const petsYes = document.getElementById('mascota-si');
    const petsNo = document.getElementById('mascota-no');
    const petsNumber = document.getElementById('num-mascotas');

    // Función para actualizar el estado del campo y cambiar su color
    function updatePetsNumberField() {
        if (petsNumber.disabled) {
            petsNumber.classList.remove('bg-white');
            petsNumber.classList.add('bg-cianna-gray');
        } else {
            petsNumber.classList.remove('bg-cianna-gray');
            petsNumber.classList.add('bg-white');
        }
    }

    petsYes.addEventListener('change', () => {
        petsNumber.disabled = false;
        updatePetsNumberField();
    });

    petsNo.addEventListener('change', () => {
        petsNumber.disabled = true;
        updatePetsNumberField();
    });

    // Inicializar el color del campo según su estado actual
    updatePetsNumberField();
    ////////////////////////////////

    // PARA MOSTRAR CAMPO DE NOMBRE ENFERMEDADES
    const medCondYes = document.getElementById('padecimiento-si');
    const medCondNo = document.getElementById('padecimiento-no');
    const medCondName = document.getElementById('nom-padecimiento');

    // Función para actualizar el estado del campo y cambiar su color
    function updateMedCondNameField() {
        if (medCondName.disabled) {
            medCondName.classList.remove('bg-white');
            medCondName.classList.add('bg-cianna-gray');
        } else {
            medCondName.classList.remove('bg-cianna-gray');
            medCondName.classList.add('bg-white');
        }
    }

    medCondYes.addEventListener('change', () => {
        medCondName.disabled = false;
        updateMedCondNameField();
    });

    medCondNo.addEventListener('change', () => {
        medCondName.disabled = true;
        updateMedCondNameField();
    });

    // Inicializar el color del campo según su estado actual
    updateMedCondNameField();
    
    /////////////////////////
</script>

<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        var imageContainer = document.getElementById('imageContainer');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                imageContainer.style.display = 'block'; // Mostrar el contenedor de imagen
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "#";
            imageContainer.style.display = 'none'; // Ocultar el contenedor de imagen
        }
    }
</script>