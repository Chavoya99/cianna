<!-- resources/views/components/custom-select.blade.php -->
<select {{ $attributes->merge(['class' => 'block w-full px-4 py-2 mt-2 border border-cianna-gray rounded-md focus:outline-none focus:ring-1 focus:ring-cianna-orange focus:border-cianna-orange shadow-cianna-orange hover:cursor-pointer' ]) }}>
{{ $slot  }}
</select>