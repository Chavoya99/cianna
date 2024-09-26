<div>
    @if (!$isFavorited)
        <button class="mt-4 w-1/2 bg-cianna-orange hover:bg-orange-300 text-white font-bold 
            py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
            wire:click="favorito">
            <i class="mr-2 fa-regular fa-star"></i>
            Agregar a favoritos
        </button>
    @else
        <button class="mt-4 w-1/2 bg-gray-600 hover:bg-gray-400 text-white font-bold py-2 px-4
            rounded focus:outline-none focus:shadow-outline"
            wire:click="favorito">
            <i class="fa fa-star"></i>
            Quitar de favoritos
        </button>
    @endif
    
</div>
