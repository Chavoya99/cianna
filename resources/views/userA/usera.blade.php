<!-- resources/views/usera.blade.php -->
<form method="POST" action="">
    <div class="font-sans">
        <label>Nombre</label>
        <x-custom-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nombre" />
    </div>
    <!-- Otros campos del formulario -->
</form>
