<!-- resources/views/usera.blade.php -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
@section('title') {{'Configura tu cuenta'}} @endsection
<x-guest-layout>
    <!-- Authentication -->
    <x-configuracion-cuenta-card>
        <!--MENSAJES DE ERROR -->
        <x-validation-errors/>
        
        <!-- Authentication -->

        <!-- Reemplazar el sigueinte link por un elemento en navbar  -->

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <!-- CONTENEDOR PRINCIPAL DEL FORMULARIO -->
        <div class="flex justify-center w-full bg-cianna-white">
            <!-- FORMULARIO -->
            <form class="w-full" id="configForm" action="{{route('guardar_configuracion_inicial_cuenta')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- TÍTULO -->
                <div class="relative px-20 bg-cianna-white w-4/5">
                    <h1 class="text-cianna-orange text-6xl">Configuración de la cuenta</h1>
                </div>
                
                <!-- CONTENEDOR HORIZONTAL 1 -->
                <div class="flex w-full mt-8">
                    <!-- CONTENEDOR DESCRIPCIÓN -->
                    <div class="relative px-20 bg-cianna-white" style="width: 57%;">
                        <x-custom-label for="desc">Cuéntanos sobre ti</x-custom-label>
                        <x-about-you></x-about-you>
                    </div>
                    <!-- CONTENEDOR SUP/DER FOTO DE PERFIL -->
                    <div class="bg-cianna-white px-44" style="width: 43%;">
                        <x-foto-perfil></x-foto-perfil>
                    </div>
                </div>
                

                <!-- CONTENEDOR HORIZONTAL 2 -->
                <div class="flex w-full mt-3">
                    <!-- CONTENEDOR IZQ MASCOTAS -->
                    <div class="relative px-20 bg-cianna-white" style="width: 57%">
                        <x-has-pets></x-has-pets>
                    </div>
                    <!-- CONTENEDOR DER EDAD Y SEXO-->
                    <div class="px-44 bg-cianna-white" style="width: 43%">
                        <x-age-sex></x-age-sex>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 2 -->

                <!-- CONTENEDOR HORIZONTAL 3 -->
                <div class="flex w-full bg-cianna-white mt-3">
                    <!-- CONTENEDOR IZQ PADECIMIENTOS -->
                    <div class="relative px-20" style="width: 57%">
                        <x-medical-conditions></x-medical-conditions>
                    </div>
                    <!-- CONTENEDOR DEL CODIGO-->
                    <div class="px-44" style="width: 43%">
                        <x-custom-label>Código de estudiante</x-custom-label>
                        <x-custom-input id="codigo" name="codigo" class="block mt-1 w-full h-8 text-sm" type="text" minlength="9" maxlength="9" value="{{old('codigo')}}" pattern="[0-9]{9}" required autocomplete="codigo" placeholder="El mismo con el que ingresas a SIIAU" />
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 3 -->

                <!-- CONTENEDOR HORIZONTAL 4 -->
                <div class="flex w-full bg-cianna-white mt-3">
                    <!-- CONTENEDOR IZQ LIFESTYLE -->
                    <div class="relative px-20" style="width: 57%">
                        <x-lifestyle></x-lifestyle>
                    </div>
                    <!-- CONTENEDOR DER CARRERA -->
                    <div class="px-44" style="width: 43%">
                        <x-career></x-career>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 4 -->

                <!-- CONTENEDOR HORIZONTAL 5 -->
                <div class="flex w-full bg-cianna-white mt-3">
                    <!-- CONTENEDOR IZQ  -->
                    <div class="relative px-20" style="width: 57%"></div>
                    <!-- CONTENEDOR DER KARDEX -->
                    <div class="px-44" style="width: 43%">
                        <x-subir-kardex><label>Sube aquí tu kárdex</label></x-subir-kardex>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 5 -->

                <!-- CONTENEDOR HORIZONTAL 6 -->
                <div class="flex w-full bg-cianna-white mt-3">
                    <!-- CONTENEDOR IZQ  -->
                    <div class="relative px-20" style="width: 57%"></div>
                    <!-- CONTENEDOR DER BOTÓN ACEPTAR -->
                    <div class="px-44" style="width: 43%">
                        <button class="block w-full bg-cianna-blue hover:bg-sky-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" onclick="displayFormData()">
                            Enviar
                        </button>
                    </div>
                </div>
                <!-- CONTENEDOR HORIZONTAL 6 -->
            </form>
        </div>
        <div class="relative ml-20 -mt-28 z-10 bg-cianna-blue hover:bg-sky-900 text-white font-bold 
                    w-32 h-8 px-2 py-1 rounded focus:outline-none focus:shadow-outline">
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Cerrar sesión') }}
                </a>
            </form>
        </div>
    </x-configuracion-cuenta-card>
</x-guest-layout>

<!-- SCRIPTS -->

<script>
    // MOSTRAR LO ENVIADO
    function displayFormData() {
    const form = document.getElementById('configForm');
    const desc = form.elements['desc'].value;
    const codigo = form.elements['codigo'].value;
    // Recoger otros valores según sea necesario
    
    document.getElementById('displayDesc').innerText = desc;
    document.getElementById('displayCodigo').innerText = codigo;
    // Mostrar otros valores en la sección de visualización
    
    document.getElementById('formDataDisplay').style.display = 'block';
}
</script>

<script>
    // PARA CONTAR LOS CARACTERES EN LA DESCRIPCION
    document.addEventListener('DOMContentLoaded', (event) => {
        const textarea = document.getElementById('desc');
        const charCount = document.getElementById('char-count');
        const maxLength = textarea.getAttribute('maxlength');

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
