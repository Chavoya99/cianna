<!-- resources/views/components/button-link.blade.php -->
<a {{ $attributes->merge(['class' => 'px-4 py-1 mt-2 bg-white font-semibold rounded-md shadow-md hover:bg-cianna-orange focus:outline-none focus:ring-2 focus:ring-cianna-orange focus:ring-opacity-75 transition-transform transform hover:scale-110']) }}>
    {{ $slot }}
</a>


