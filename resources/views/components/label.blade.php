@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-black py-1']) }}>
    {{ $value ?? $slot }}
</label>
