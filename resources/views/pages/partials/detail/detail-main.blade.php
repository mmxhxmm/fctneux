<section class="max-w-7xl mx-auto px-6 py-12">
    @foreach ($empresas as $empresa)
        @if ($empresa->id == $id)
        <div class="bg-white rounded-2xl shadow-xl p-10 space-y-12 border border-blue">
            <!-- ENCABEZADO EMPRESA -->
            <div class="w-full flex relative pb-4">
                <div class="absolute left-1/2 transform -translate-x-1/2 text-center">
                    <h2 class="text-3xl font-bold text-blue tracking-wide mb-2">Datos de la Empresa</h2>
                    <p class="text-gray-500 text-sm">Información general y detalles administrativos</p>
                </div>

                <!-- Spacer -->
                <div class="invisible">This balances the right buttons</div>
                
                <div class="w-full flex justify-end items-center gap-2">
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'coordinador')
                    <button type="button" onclick="confirmDeleteEmpresa({{ $empresa->id }})"
                        class="bg-red-500 text-white px-2 py-1 rounded">
                        Eliminar
                    </button>
                    @endif

                    <button 
                        id="edit-btn-empresa"
                        type="button" 
                        class="edit-btn px-2 py-1 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
                        data-target="empresa">Editar
                    </button>
                </div>

                <form id="delete-form-empresa-{{ $empresa->id }}" method="POST" action="{{ route('empresa.delete', $empresa->id) }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <script>
                    function confirmDeleteEmpresa(id) {
                        if (confirm('¿Estás seguro que quieres eliminar esta empresa?')) {
                            document.getElementById('delete-form-empresa-' + id).submit();
                        }
                    }
                </script>
            </div>

            <!-- EMPRESA -->
            @include("pages.partials.detail.empresa")

            <!-- RESPONSABLES CONVENIO -->
            @include("pages.partials.detail.responsable-convenio")

            <hr>

            <!-- CENTROS DE TRABAJO -->

            @include("pages.partials.detail.centro-trabajo")

            <hr>

            <!-- PRÁCTICAS -->
            @include("pages.partials.detail.practica")

        @endif
    @endforeach
</section>