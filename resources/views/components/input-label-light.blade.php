@props(['for' => '', 'value' => ''])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'block font-medium text-sm mb-1']) }}>
    {!! $value ?? $slot !!}
</label>
