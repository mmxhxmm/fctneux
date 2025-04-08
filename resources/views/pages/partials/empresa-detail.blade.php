<section class="max-w-7xl mx-auto px-6 py-12">
    @foreach ($empresas as $empresa)
        @if ($empresa->id == $id)
        <div class="bg-white rounded-2xl shadow-xl p-10 space-y-12 border border-blue">

            <!-- ENCABEZADO EMPRESA -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-blue tracking-wide mb-2">Datos de la Empresa</h2>
                <p class="text-gray-500 text-sm">Información general y detalles administrativos</p>
            </div>
            <div class="grid md:grid-cols-2 gap-8 text-gray-800 text-[15px] leading-relaxed">
                <div class="space-y-2">
                    <p><span class="font-semibold">Nombre:</span> {{ $empresa->nombre }}</p>
                    <p><span class="font-semibold">CIF:</span> {{ $empresa->cif }}</p>
                    <p><span class="font-semibold">Colaboración:</span> {{ $empresa->colaboracion }}</p>
                    <p><span class="font-semibold">Gestiones:</span> {{ $empresa->gestiones }}</p>
                    <p><span class="font-semibold">Modalidad:</span> {{ $empresa->modalidad }}</p>
                    <p><span class="font-semibold">Familia Personal:</span> {{ $empresa->familiaPersonal }}</p>
                    <p><span class="font-semibold">Oferta Laboral:</span> {{ $empresa->ofertaLaboral }}</p>
                </div>
                <div class="space-y-2">
                    <p><span class="font-semibold">Entidad:</span> {{ $empresa->entidad }}</p>
                    <p><span class="font-semibold">Ubicación:</span> {{ $empresa->ubicacion }}</p>
                    <p><span class="font-semibold">Municipio:</span> {{ $empresa->municipio }}</p>
                    <p><span class="font-semibold">Dirección:</span> {{ $empresa->direccion }}</p>
                    <p><span class="font-semibold">Código Postal:</span> {{ $empresa->codigoPostal }}</p>
                    <p><span class="font-semibold">Observaciones:</span> {{ $empresa->observaciones }}</p>
                </div>
            </div>

            <!-- RESPONSABLES DE CONVENIO -->
            @foreach ($empresa->responsablesConvenio as $resConv)
            <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm">
                <h3 class="text-xl font-semibold text-blue mb-4">Responsable de Convenio</h3>
                <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                    <p><strong>DNI:</strong> {{ $resConv->dni }}</p>
                    <p><strong>Nombre Completo:</strong> {{ $resConv->nombre }} {{ $resConv->apellido }}</p>
                    <p><strong>Teléfono:</strong> {{ $resConv->telefono }}</p>
                    <p><strong>Email:</strong> {{ $resConv->email }}</p>
                </div>
            </div>
            @endforeach

            <!-- CENTROS DE TRABAJO -->
            @foreach ($empresa->centrosTrabajo as $centro)
            <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm">
                <h3 class="text-xl font-semibold text-blue mb-4">Centro de Trabajo - {{ $centro->municipio }}</h3>
                <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                    <p><strong>Dirección:</strong> {{ $centro->direccion }}</p>
                    <p><strong>Código Postal:</strong> {{ $centro->codigoPostal }}</p>
                    <p><strong>Ubicación:</strong> {{ $centro->ubicacion }}</p>
                    <p><strong>Municipio:</strong> {{ $centro->municipio }}</p>
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

            <!-- PRÁCTICAS -->
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
</section>
