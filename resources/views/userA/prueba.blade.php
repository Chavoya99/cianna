<div class="min-h-screen relative flex flex-col pt-6 sm:pt-0" style="background-color: #F1EFE7;">
    <div class="w-full h-[15vh] overflow-hidden flex justify-end px-4 py-4" style="background-color: #FFFFFF;">
        <div style="background-color: #DA3B19;">
            {{ $logo }}
        </div>
    </div>
    <div class="flex" style="background-color: #001FFF;">
        
        <div class="w-[70%] h-[85vh] overflow-hidden flex justify-start" style="background-color: #2EFF00">
            <h1>SOY EL DIV 2</h1>
        </div>
        <div class="w-[30%] h-[85vh] overflow-hidden flex justify-end" style="color:white; background-color: #000000;">
            <h1>SOY EL DIV 3</h1>
        </div>
    </div>
</div>


<div class="flex justify-center">
    <form class="w-full max-w-lg">
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first-name">
                    Nombre
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="first-name" type="text" placeholder="Nombre">
            </div>
            <div class="md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last-name">
                    Apellido
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last-name" type="text" placeholder="Apellido">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    Correo electrónico
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" type="email" placeholder="Correo electrónico">
            </div>
            <div class="md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                    Teléfono
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="phone" type="text" placeholder="Teléfono">
            </div>
        </div>
        <!-- Otros campos del formulario -->
        <div class="md:flex md:items-center">
            <div class="md:w-1/2 px-3">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                    Enviar
                </button>
            </div>
        </div>
    </form>
</div>



<!--
    <div class="w-1/2 h-1/2 bg-red-500 flex items-center justify-center">
            <h2 class="text-white text-center">Contenedor Rojo</h2>
        </div>
-->
