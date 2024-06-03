<!-- resources/views/usera.blade.php -->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<x-guest-layout>
    <x-configuracion-cuenta-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <!-- CONTENEDOR PRINCIPAL DEL FORMULARIO -->
        <div class="flex justify-center w-full">
            <!-- FORMULARIO -->
            <form class="w-full">
                <!-- TÍTULO -->
                <div class="relative px-20 bg-cianna-white" style="width: 80%;">
                    <h1 class="text-cianna-orange" style="font-size: 64px;">Configuración de la cuenta</h1>
                </div>
                
                <!-- CONTENEDOR HORIZONTAL 1 -->
                <div class="flex w-full">
                    <!-- CONTENEDOR DESCRIPCIÓN -->
                    <div class="relative px-20 bg-cianna-white" style="width: 60%;">
                        <x-custom-label for="desc">Cuéntanos sobre ti</x-custom-label>
                        <x-about-you></x-about-you>
                    </div>
                    <!-- CONTENEDOR SUP/DER (MORADO) -->
                    <div class="px-3 bg-cianna-white" style="width: 40%;">
                        <x-foto-perfil></x-foto-perfil>
                    </div>
                </div>
                

                    <!-- CONTENEDOR HORIZONTAL 2 -->
                    <div class="flex w-full" style="background-color: #BD00FF;">
                        <!-- CONTENEDOR IZQ -->
                        <div class="relative px-20" style="width: 60%">
                            <x-has-pets></x-has-pets>
                        </div>
                        <!-- CONTENEDOR DER -->
                        <div class="relative px-3" style="width: 40%">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                                Teléfono
                            </label>
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" name="phone" type="text" placeholder="Teléfono">
                        </div>
                    </div>
                    <!-- Otros campos del formulario -->
                    <div class="flex justify-center w-full">
                        <div class="px-3">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="displayFormData()">
                                Enviar
                            </button>
                        </div>
                    </div>
                    <!-- CONTENEDOR HORIZONTAL 2 -->
            </form>
        </div>

        <!-- SE MUESTRAN DATOS -->
        <div class="flex justify-center mt-8">
            <div class="w-full max-w-lg bg-gray-100 p-6 rounded-lg shadow-md" id="formDataDisplay" style="display: none;">
                <h2 class="text-xl font-bold mb-4">Datos enviados:</h2>
                <p><strong>Nombre:</strong> <span id="displayFirstName"></span></p>
                <p><strong>Apellido:</strong> <span id="displayLastName"></span></p>
                <p><strong>Correo electrónico:</strong> <span id="displayEmail"></span></p>
                <p><strong>Teléfono:</strong> <span id="displayPhone"></span></p>
            </div>
        </div>
    </x-configuracion-cuenta-card>
</x-guest-layout>

<!-- SCRIPTS -->

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
    /////////////////////

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
    });
    /////////////////////////

    // MOSTRAR LO ENVIADO
    function displayFormData() {
        // Obtener los valores de los campos del formulario
        const firstName = document.getElementById('first-name').value;
        const lastName = document.getElementById('last-name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        // Mostrar los valores en la sección de datos enviados
        document.getElementById('displayFirstName').innerText = firstName;
        document.getElementById('displayLastName').innerText = lastName;
        document.getElementById('displayEmail').innerText = email;
        document.getElementById('displayPhone').innerText = phone;

        // Mostrar la sección de datos enviados
        document.getElementById('formDataDisplay').style.display = 'block';
    }
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
