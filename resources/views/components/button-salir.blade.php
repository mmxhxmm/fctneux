@props([
    'redirect' => route('empresa-index'),
])


<form action="{{ $redirect }}" method="GET" class="inline-block">
    <button
        type="submit"
        aria-label="Salir del formulario"
        class="px-4 py-2 rounded-full bg-red-700 hover:bg-red-800 text-white font-semibold text-sm shadow transition">
        {{ __('Salir') }}
    </button>
</form>

