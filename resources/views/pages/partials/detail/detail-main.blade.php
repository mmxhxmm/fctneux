<section class="max-w-7xl mx-auto px-6 py-12">
    @foreach ($empresas as $empresa)
        @if ($empresa->id == $id)
        <div class="bg-white rounded-2xl shadow-xl p-10 space-y-12 border border-blue">
            <!-- ENCABEZADO EMPRESA -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-blue tracking-wide mb-2">Datos de la Empresa</h2>
                <p class="text-gray-500 text-sm">Información general y detalles administrativos</p>
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