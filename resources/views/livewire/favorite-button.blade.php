<div>
    @if (!$isFavorited)
        <button class="h-3/4 w-full bg-cianna-orange hover:bg-orange-300 text-white font-bold py-2 px-4
            rounded focus:outline-none focus:shadow-outline"
            wire:click="favorito">
            <i class="mr-2 fa-regular fa-star"></i>
            Agregar a favoritos
        </button>
    @else
        <button class="h-3/4 w-full bg-gray-600 hover:bg-gray-400 text-white font-bold py-2 px-4
            rounded focus:outline-none focus:shadow-outline"
            wire:click="favorito">
            <i class="mr-2 fa-solid fa-star"></i>
            Quitar de favoritos
        </button>
    @endif
    
</div>
