
<div>
    @if(!$isRequested)
        <button class="mt-4 w-3/4 bg-cianna-blue hover:bg-sky-900 text-white font-bold 
            py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            wire:click="postulacion">
            <i class="mr-2 fa-solid fa-envelope-open-text"></i>
            Postularse
        </button>
    @else
        <a href="{{route('ver_postulaciones')}}">
            <button class="mt-4 w-3/4 bg-green-800 hover:bg-lime-600 text-white font-bold 
                py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                ¡Ya estás postulado!<br>
                <i class="fa-solid fa-up-right-from-square mr-2"></i>
                Ver postulaciones
            </button>
        </a>
    @endif
</div>

