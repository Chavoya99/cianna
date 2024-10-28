
<div>
    @if(!$isRequested)
        <button class="mt-4 w-3/4 bg-cianna-blue hover:bg-sky-900 text-white font-bold 
        py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
        wire:click="postulacion">
            <i class="mr-2 fa-solid fa-envelope-open-text"></i>
            Postularse
        </button>
    @else
        <button class="mt-4 w-3/4 bg-cianna-blue hover:bg-sky-900 text-white font-bold 
            py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            <i class="mr-2 fa-solid fa-envelope-circle-check"></i>
            Postulado
        </button>
    @endif
</div>

