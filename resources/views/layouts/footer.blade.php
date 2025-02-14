<footer class="bg-primary h-17 w-full">
    <div class="pt-8 text-center text-white text-sm font-roboto_condensed">
        <div class="flex justify-center gap-x-3 mb-3">
            <a href="" class="flex items-center justify-center gap-x-1 hover:underline focus:outline-none focus:underline" title="Ir a la página de Empresa">
                <img src="{{ asset('images/icons/icons8-business-96.png') }}" alt="" width="20px" class="invert brightness-0">
                <p>Empresas</p>
            </a>
            <label>-</label>
            <a href="" class="flex items-center justify-center gap-x-1 hover:underline focus:outline-none focus:underline" title="Ir a la página de Tareas">
                <img src="{{ asset('images/icons/icons8-address-book-96.png') }}" alt="" width="20px" class="invert brightness-0">
                <p>Tareas</p>
            </a>
            <label>-</label>
            <a href="" class="flex items-center justify-center gap-x-1 hover:underline focus:outline-none focus:underline" title="Ir a la página de Usuarios">
                <img src="{{ asset('images/icons/icons8-people-96.png') }}" alt="" width="20px" class="invert brightness-0">
                <p>Usuarios</p>
            </a>
        </div>
        <p>&copy;2025 CEAC FP. Todos los derechos reservados.<p>
    </div>
    <div class="flex justify-end items-end">
        <a href="{{ route('dashboard') }}" class="inline-block pb-2 px-4" title="Ir a la página de Dashboard">
            <p class="text-2xl text-white font-hammersmith">FCT<span class="text-orange">Nexus</span></p>
        </a>
    </div>
</footer>