<section class="flex flex-col space-y-12">
    @foreach ($empresa->practica as $index => $practica)
    <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
        <!-- Toggleable Edit Button -->
        <button 
            id="edit-btn-res-conv-{{ $index }}"
            type="button" 
            class="edit-btn absolute px-2 rounded top-6 right-6 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-target="res-conv-{{ $index }}"> Editar
        </button>
        
        <!-- Display Mode -->
        <div id="display-res-conv-{{ $index }}">
            <h3 class="text-xl font-semibold text-blue mb-4">Practica</h3>
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
                    <summary class="cursor-pointer text-blue font-semibold">Tutor Académico - {{ $tutor->nombre }} {{ $tutor->apellido }}</summary>
                    <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                        <p><strong>DNI:</strong> {{ $tutor->dni }}</p>
                        <p><strong>Nombre:</strong> {{ $tutor->nombre }} {{ $tutor->apellido }}</p>
                        <p><strong>Teléfono:</strong> {{ $tutor->telefono }}</p>
                        <p><strong>Email:</strong> {{ $tutor->email }}</p>
                    </div>
                </details>
                @endforeach

                <!-- TUTORES EMPRESA -->
                @foreach ($practica->tutoresEmpresa as $tutorEmp)
                <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                    <summary class="cursor-pointer text-blue font-semibold">Tutor Empresa - {{ $tutorEmp->nombre }} {{ $tutorEmp->apellido }}</summary>
                    <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                        <p><strong>DNI:</strong> {{ $tutorEmp->dni }}</p>
                        <p><strong>Nombre:</strong> {{ $tutorEmp->nombre }} {{ $tutorEmp->apellido }}</p>
                        <p><strong>Teléfono:</strong> {{ $tutorEmp->telefono }}</p>
                        <p><strong>Email:</strong> {{ $tutorEmp->email }}</p>
                    </div>
                </details>
                @endforeach
        </div>
        
        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-res-conv-{{ $index }}" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-4">Editar Practica</h3>
            <form method="POST" action="{{ route('practica.update', $practica->id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')
                
                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="cursoAcademico-{{ $index }}" value="Curso Academico" />
                        <x-text-input-light id="cursoAcademico-{{ $index }}" name="cursoAcademico" value="{{ $practica->cursoAcademico }}" />
                    </div>

                    <div>
                        <x-input-label for="periodoFrom-{{ $index }}" value="Periodo From" />
                        <x-text-input-light id="periodoFrom-{{ $index }}" name="periodoFrom" value="{{ $practica->periodoFrom }}" />
                    </div>

                    <div>
                        <x-input-label for="horarioFrom-{{ $index }}" value="Horario From" />
                        <x-text-input-light id="horarioFrom-{{ $index }}" name="horarioFrom" value="{{ $practica->horarioFrom }}" />
                    </div>
                </div>
                
                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="numPlazasAsignadas-{{ $index }}" value="Numero de Plazas Asignadas" />
                        <x-text-input-light id="numPlazasAsignadas-{{ $index }}" name="numPlazasAsignadas" value="{{ $practica->numPlazasAsignadas }}" />
                    </div>

                    <div>
                        <x-input-label for="periodoTo-{{ $index }}" value="Periodo To" />
                        <x-text-input-light id="periodoTo-{{ $index }}" name="periodoTo" value="{{ $practica->periodoTo }}" />
                    </div>
                    
                    <div>
                        <x-input-label for="horarioTo-{{ $index }}" value="Horario From" />
                        <x-text-input-light id="horarioTo-{{ $index }}" name="horarioTo" value="{{ $practica->horarioTo }}" />
                    </div>
                </div>

                <div class="md:col-span-2 space-y-4">
                    <div>
                        <x-input-label for="convenioMarco-{{ $index }}" value="Convenio Marco" />
                        <x-text-input-light id="convenioMarco-{{ $index }}" name="convenioMarco" value="{{ $practica->convenioMarco }}" />
                    </div>
                </div>

                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="usoLogos-{{ $index }}" value="Uso Logos" />
                        <x-text-input-light id="usoLogos-{{ $index }}" name="usoLogos" value="{{ $practica->usoLogos }}" />
                    </div>
                </div>

                <div class="md:col-span-3">
                    <x-input-label for="observaciones-{{ $index }}" value="Observaciones" />
                    <textarea id="observaciones" name="observaciones" rows="3" class="block w-full border-gray-700 bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $practica->observaciones }}</textarea>
                </div>
                
                <div class="md:col-span-3 flex justify-end gap-4">
                    <button type="button" class="cancel-edit-btn" data-target="res-conv-{{ $index }}">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit buttons
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`display-${target}`).classList.add('hidden');
                document.getElementById(`edit-${target}`).classList.remove('hidden');
                document.getElementById(`edit-btn-${target}`).classList.add('hidden');
            });
        });
        
        // Cancel buttons
        document.querySelectorAll('.cancel-edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`edit-${target}`).classList.add('hidden');
                document.getElementById(`display-${target}`).classList.remove('hidden');
                document.getElementById(`edit-btn-${target}`).classList.remove('hidden');
            });
        });
    });
</script>