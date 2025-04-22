@props([
    'redirect' => route('empresa-index'),
])


<form action="{{ $redirect }}" method="GET" class="inline-block">
    <div class="absolute left-0 top-[4em] animate-left">
        <button
            type="submit"
            aria-label="Salir del formulario"
            class="justify-start p-2 px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[240px] h-[40px] hover:text-white hover:border-none text-[16px] text-white text-left flex-grow-0 mb-6">
            {{ __('<<< Volver a las empresas') }}
        </button>
    </div>
</form>

