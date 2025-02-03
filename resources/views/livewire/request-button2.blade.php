<div class="w-1/2 px-2 flex justify-center">

    @if(!$isRequested)
        <button class="w-full bg-cianna-blue hover:bg-sky-900 text-white 
            font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            wire:click="postulacion">
            <i class="mr-2 fa-solid fa-envelope-open-text"></i>
            Postularse
        </button>
    @else
    <div class="w-full bg-green-800 hover:bg-lime-600 text-white 
        font-bold rounded focus:outline-none focus:shadow-outline">
        <a href="{{route('ver_postulaciones')}}">
            <button class="w-full py-2 px-4">
                ¡Ya estás postulado!<br>
                <i class="fa-solid fa-up-right-from-square mr-2"></i>
                Ver postulaciones
            </button>
        </a>
    </div>
        
    @endif
</div>
