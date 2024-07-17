@props(['defaultProfileImage' => asset('img/avatar-default-svgrepo-com.png')])
<div class="w-full flex items-center justify-between bg-white px-20 py-3">
    <div>
        <a href="homeA" class="text-cianna-orange font-bold">INICIO</a>
    </div>
    <div>
        <form>  
            <div class="relative w-96 h-10">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="search" id="busqueda" class="block w-full h-full ps-10 text-sm text-gray-900 border border-cianna-gray rounded-lg bg-gray-50 focus:ring-cianna-orange focus:border-cianna-orange " placeholder="Buscador" required />
                <button type="submit" class="text-white bg-cianna-blue absolute end-0.5 bottom-0.5 hover:bg-sky-900 focus:ring-4 focus:outline-none focus:ring-sky-400 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
            </div>
        </form>
    </div>
    <div class="flex items-center bg-gray-300 px-4 py-2 rounded-md cursor-pointer">
        <i class="fa-solid fa-gear mr-2"></i>
        Preferencias de búsqueda
    </div>
    <div class="relative" id="dropDownButton">
        <div class="flex items-center cursor-pointer" onclick="toggleDropDown()">
            @if (Auth::check())
                <?php

                $imagen = Auth::user()->archivos()->where('archivo_type', 'img_perf')->get();
                ?>
                {{Auth::user()->name}}
                <img class="h-8 w-8 rounded-full border border-cianna-gray ml-2 mr-2" src="{{asset('storage/'. $imagen[0]->ruta_archivo)}}" alt="Foto de perfil">
                <i class="fa-solid fa-chevron-down text-cianna-gray"></i>
            @else
                Invitado
                <img class="h-8 w-8 rounded-full border border-cianna-gray ml-2 mr-2" src="{{$defaultProfileImage}}" alt="Foto de perfil">
                <i class="fa-solid fa-chevron-down text-cianna-gray"></i>
            @endif
            
        </div>
        <div id="dropDown" class="absolute right-0 mt-2 w-48 bg-white bg-opacity-75 border-cianna-gray border-[1px] shadow-md py-2 px-2 rounded-md hidden z-10 transition-all duration-300 transform -translate-y-full opacity-0">
            <!-- SOLO MOSTRAR SI NO SE HA INICIADO SESIÓN -->
            @if(!Auth::check())
                <a href="login"><div class="flex bg-cianna-gray justify-center px-1 py-1 rounded-md w-full hover:bg-cianna-orange cursor-pointer">Iniciar sesión</div></a>
            @else
                <a href="my-profile"><div class="mt-1 flex bg-cianna-gray justify-center px-1 py-1 rounded-md w-full hover:bg-cianna-orange cursor-pointer">Perfil</div></a>
                <a href="configuracion_inicial_cuenta"><div class="mt-1 flex bg-cianna-gray justify-center px-1 py-1 rounded-md w-full hover:bg-cianna-orange cursor-pointer">Configuración</div></a>
                <!-- SOLO MOSTRAR SI YA SE HA INICIADO SESIÓN -->
                <div class="mt-1 flex bg-cianna-gray justify-center px-1 py-1 rounded-md w-full hover:bg-cianna-orange cursor-pointer">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Cerrar sesión') }}
                    </a>
                    </form>
                </div>
            @endif
            
        </div>
    </div>
</div>

<script>
    function toggleDropDown(){
        let dropDown = document.getElementById('dropDown');
        if (dropDown.classList.contains('hidden')) {
            dropDown.classList.remove('hidden');
            setTimeout(() => {
                dropDown.classList.remove('opacity-0', '-translate-y-full');
                dropDown.classList.add('opacity-100', 'translate-y-0');
            }, 10);
        } else {
            dropDown.classList.add('opacity-0', '-translate-y-full');
            dropDown.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => {
                dropDown.classList.add('hidden');
            }, 300);
        }
    }

    // Cerrar el dropdown al hacer clic fuera de él
    document.addEventListener('click', (event) => {
        let dropDown = document.getElementById('dropDown');
        let dropDownButton = document.getElementById('dropDownButton');
        if (!dropDownButton.contains(event.target) && !dropDown.contains(event.target)) {
            dropDown.classList.add('opacity-0', '-translate-y-full');
            dropDown.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => {
                dropDown.classList.add('hidden');
            }, 300);
        }
    });
</script>

<style>
    /* Añadir transiciones suaves a la propiedad transform */
    .transition-transform {
        transition: transform 0.3s ease-in-out;
    }
</style>

