<div class="min-h-screen relative flex flex-col pt-6 sm:pt-0 bg-cianna-white">
    <!-- LOGO -->
    <div class="w-full h-full overflow-hidden flex justify-end px-4 py-4 bg-cianna-white">
        <div>
            {{ $logo }}
        </div>
    </div>
    <!-- CONTENEDOR DEL FORMULARIO (AZUL) -->
    <div class="bg-cianna-white">
        {{ $slot }}
    </div>
</div>


<!--
    <div class="w-1/2 h-1/2 bg-red-500 flex items-center justify-center">
            <h2 class="text-white text-center">Contenedor Rojo</h2>
        </div>
-->
