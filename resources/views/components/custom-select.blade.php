<!-- resources/views/components/custom-select.blade.php -->
<select {{ $attributes->merge(['class' => 'block w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500']) }}>
{{ $slot  }}
</select>