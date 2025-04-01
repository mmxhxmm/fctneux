@props([
    'value',
    'selectedValue' => null,
    'label'
])

<option value="{{ $value }}" {{ $value == $selectedValue ? 'selected' : '' }}>
    {{ $label }}
</option>