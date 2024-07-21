@props(['value'])

<label {{ $attributes->merge(['class' => 'block tracking-wide text-black text-s font-bold mb-2']) }}>
    {{ $value ?? $slot }}
</label>