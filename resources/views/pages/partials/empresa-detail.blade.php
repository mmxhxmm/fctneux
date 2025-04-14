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

            <!-- CENTROS DE TRABAJO -->
            <div class="grid grid-cols-2 gap-6">
            @foreach ($empresa->centrosTrabajo as $centro)
            <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm">
                <h3 class="text-xl font-semibold text-blue mb-4">Centro de Trabajo - {{ $centro->municipio }}</h3>
                <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                    <p><strong>Código Postal:</strong> {{ $centro->codigoPostal }}</p>
                    <p><strong>Comunidad:</strong> {{ $centro->comunidad }}</p>
                    <p><strong>Provincia:</strong> {{ $centro->provincia }}</p>
                    <p><strong>Municipio:</strong> {{ $centro->municipio }}</p>
                    <p><strong>Dirección:</strong> {{ $centro->direccion }}</p>
                </div>

                @foreach ($centro->personaContacto as $persContacto)
                <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                    <summary class="cursor-pointer text-blue font-semibold">Persona de Contacto - {{ $persContacto->nombre }}</summary>
                    <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                        <p><strong>DNI:</strong> {{ $persContacto->dni }}</p>
                        <p><strong>Nombre Completo:</strong> {{ $persContacto->nombre }} {{ $persContacto->apellido }}</p>
                        <p><strong>Teléfono:</strong> {{ $persContacto->telefono }}</p>
                        <p><strong>Email:</strong> {{ $persContacto->email }}</p>
                    </div>
                </details>
                @endforeach
            </div>
            @endforeach
            </div>

            <!-- PRÁCTICAS -->
            <div class="grid grid-cols-2 gap-6">
            @foreach ($empresa->practica as $practica)
            <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm">
                <h3 class="text-xl font-semibold text-blue mb-4">Prácticas - {{ $practica->cicloFormativo }}</h3>
                <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                    <p><strong>Curso Académico:</strong> {{ $practica->cursoAcademico }}</p>
                    <p><strong>Plazas:</strong> {{ $practica->numPlazasAsignadas }}</p>
                    <p><strong>Periodo:</strong> {{ $practica->periodoFrom }} - {{ $practica->periodoTo }}</p>
                    <p><strong>Horario:</strong> {{ $practica->horarioFrom }} - {{ $practica->horarioTo }}</p>
                    <p><strong>Convenio Marco:</strong> {{ $practica->convenioMarco }}</p>
                    <p><strong>Uso Logos:</strong> {{ $practica->usoLogos }}</p>
                    <p><strong>Observaciones:</strong> {{ $practica->observaciones }}</p>
                </div>

                <!-- TUTORES ACADÉMICOS -->
                @foreach ($practica->tutores as $tutor)
                <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                    <summary class="cursor-pointer text-blue font-semibold">Tutor Académico - {{ $tutor->nombre }}</summary>
                    <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                        <p><strong>DNI:</strong> {{ $tutor->dni }}</p>
                        <p><strong>Nombre Completo:</strong> {{ $tutor->nombre }} {{ $tutor->apellido }}</p>
                        <p><strong>Teléfono:</strong> {{ $tutor->telefono }}</p>
                        <p><strong>Email:</strong> {{ $tutor->email }}</p>
                    </div>
                </details>
                @endforeach

                <!-- TUTORES EMPRESA -->
                @foreach ($practica->tutoresEmpresa as $tutorEmp)
                <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                    <summary class="cursor-pointer text-blue font-semibold">Tutor Empresa - {{ $tutorEmp->nombre }}</summary>
                    <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                        <p><strong>DNI:</strong> {{ $tutorEmp->dni }}</p>
                        <p><strong>Nombre Completo:</strong> {{ $tutorEmp->nombre }} {{ $tutorEmp->apellido }}</p>
                        <p><strong>Teléfono:</strong> {{ $tutorEmp->telefono }}</p>
                        <p><strong>Email:</strong> {{ $tutorEmp->email }}</p>
                    </div>
                </details>
                @endforeach
            </div>
            @endforeach
        </div>
        @endif
    @endforeach

    <?php
        function getComunidadAttribute($value) {
            $key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
            $url = "https://apiv1.geoapi.es/comunidades?type=JSON&key=$key";
            
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            foreach ($data['data'] as $comunidad) {
                if ($comunidad['CCOM'] == $value) {
                    return ucwords(mb_strtolower($comunidad['COM']));
                }
            }

            return $value;
        }

        function getProvinciaAttribute($value) {
            $key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
            $url = "https://apiv1.geoapi.es/provincias?type=JSON&key=$key";
            
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            foreach ($data['data'] as $provincias) {
                if ($provincias['CPRO'] == $value) {
                    return ucwords(mb_strtolower($provincias['PRO']));
                }
            }

            return $value;
        }

        function getMunicipioAttribute($value) {
            return ucwords(mb_strtolower($value));
        }
    ?>
</section>