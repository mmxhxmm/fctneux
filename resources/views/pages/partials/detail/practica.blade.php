<section class="flex flex-col space-y-12">
    @foreach ($empresa->practica as $index => $practica)
    <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
        <!-- Toggleable Edit Button -->
        <button 
            id="edit-btn-practica-{{ $index }}"
            type="button" 
            class="edit-btn absolute px-2 rounded top-6 right-6 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-target="practica-{{ $index }}"> Editar
        </button>
        
        <!-- Display Mode -->
        <div id="display-practica-{{ $index }}">
            <h3 class="text-xl font-semibold text-blue mb-8">Practica</h3>
            <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                <p><strong>Ciclo Formativo:</strong> {{ $empresa->cicloFormativoToString($practica->cicloFormativo) }}</p>
                <p><strong>Curso Académico:</strong> {{ $practica->cursoAcademico }}</p>
                <p><strong>Plazas:</strong> {{ $practica->numPlazasAsignadas }}</p>
                <p><strong>Periodo:</strong> {{ \Carbon\Carbon::parse($practica->periodoFrom)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($practica->periodoTo)->format('d-m-Y') }}</p>
                <p><strong>Horario:</strong> {{ $practica->horarioFrom }} - {{ $practica->horarioTo }}</p>
                <p><strong>Convenio Marco:</strong> {{ $empresa->convenioMarcoToString($practica->convenioMarco) }}</p>
                <p><strong>Uso Logos:</strong> {{ $empresa->usoLogosToString($practica->usoLogos) }}</p>
                <p><strong>Observaciones:</strong> {{ $practica->observaciones }}</p>
            </div>

            <!-- Separador -->
            <div class="mt-10"></div>
            
            <!-- Display TUTORES ACADÉMICOS -->
            @foreach ($practica->tutores as $index2 => $tutor)
                <div id="display-tutor-{{ $index2 }}">
                    <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                        <summary class="cursor-pointer text-blue font-semibold">Tutor Académico - {{ $tutor->nombre }} {{ $tutor->apellido }}</summary>
                        <!-- Edit Button -->
                        <div class="w-full flex justify-end gap-2">
                            <button type="button" onclick="confirmDeleteTutorA({{ $tutor->id }})"
                                class="mt-[-25px] bg-red-500 text-white px-2 py-1 rounded">
                                Eliminar
                            </button>
                            <button 
                                id="edit-btn-tutor-{{ $index }}"
                                type="button" 
                                class="edit-btn mt-[-25px] px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
                                data-target="tutor-{{ $index }}"> Editar
                            </button>
                        </div>

                        <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                            <p><strong>DNI:</strong> {{ $tutor->dni }}</p>
                            <p><strong>Nombre:</strong> {{ $tutor->nombre }} {{ $tutor->apellido }}</p>
                            <p><strong>Teléfono:</strong> {{ $tutor->telefono }}</p>
                            <p><strong>Email:</strong> {{ $tutor->email }}</p>
                        </div>
                    </details>

                    <form id="delete-form-tutor-{{ $tutor->id }}" method="POST" action="{{ route('tutor.delete', $tutor->id) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <script>
                        function confirmDeleteTutorA(id) {
                            if (confirm('¿Estás seguro que quieres eliminar este tutor académico?')) {
                                document.getElementById('delete-form-tutor-' + id).submit();
                            }
                        }
                    </script>
                </div>
            @endforeach

            <!-- Add Tutor Académico -->
            <div id="add-display-tutor-{{ $index }}">
                <div class="mt-6 bg-white border border-blue rounded-lg py-2 pr-3 pl-7 flex justify-between items-center">
                    <p class="text-blue font-semibold">Tutor Académico</p>
                    <button 
                        type="button" 
                        data-target="tutor-{{ $index }}"
                        class="add-btn-tutor px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80">
                        Añadir +
                    </button>
                </div>
            </div>
            
            <!-- Form Add Tutor Académico -->
            <div id="add-form-tutor-{{ $index }}" class="hidden mt-6 bg-white border border-blue rounded-lg px-7 py-4 relative">
                <h3 class="text-md font-semibold text-blue mb-8">Añadir Tutor Académico</h3>
                <form method="POST" action="{{ route('tutor.add', $practica->id) }}" class="grid md:grid-cols-3 gap-6 mt-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="dni" value="DNI <span class='text-red-500'>*</span>" />
                        <x-text-input-light id="dni" name="dni" required />
                    </div>
                    
                    <div>
                        <x-input-label for="nombre" value="Nombre <span class='text-red-500'>*</span>" />
                        <x-text-input-light id="nombre" name="nombre" required />
                    </div>
                    
                    <div>
                        <x-input-label for="apellido" value="Apellido <span class='text-red-500'>*</span>" />
                        <x-text-input-light id="apellido" name="apellido" required />
                    </div>
                    
                    <div>
                        <x-input-label for="telefono" value="Teléfono" />
                        <x-text-input-light id="telefono" name="telefono" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input-light id="email" name="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <div class="md:col-span-3 flex justify-end gap-6">
                        <button type="button" class="cancel-add-btn-tutor" data-target="tutor-{{ $index }}">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                            Añadir
                        </button>
                    </div>
                </form>
            </div>

            <hr class="my-6 border-blue">
            
            <!-- Display TUTORES EMPRESA -->
            @foreach ($practica->tutoresEmpresa as $index3 => $tutor)
                <div id="display-tutor-empresa-{{ $index3 }}">
                    <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                        <summary class="cursor-pointer text-blue font-semibold">Tutor de Empresa - {{ $tutor->nombre }} {{ $tutor->apellido }}</summary>
                        <!-- Edit Button -->
                        <div class="w-full flex justify-end gap-2">
                            <button type="button" onclick="confirmDeleteTutorE({{ $tutor->id }})"
                                class="mt-[-25px] bg-red-500 text-white px-2 py-1 rounded">
                                Eliminar
                            </button>
                            <button 
                                id="edit-btn-tutor-empresa-{{ $index }}"
                                type="button" 
                                class="edit-btn mt-[-25px] px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
                                data-target="tutor-empresa-{{ $index }}"> Editar
                            </button>
                        </div>

                        <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                            <p><strong>DNI:</strong> {{ $tutor->dni }}</p>
                            <p><strong>Nombre:</strong> {{ $tutor->nombre }} {{ $tutor->apellido }}</p>
                            <p><strong>Teléfono:</strong> {{ $tutor->telefono }}</p>
                            <p><strong>Email:</strong> {{ $tutor->email }}</p>
                        </div>
                    </details>

                    <form id="delete-form-tutor-empresa-{{ $tutor->id }}" method="POST" action="{{ route('tutor-empresa.delete', $tutor->id) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <script>
                        function confirmDeleteTutorE(id) {
                            if (confirm('¿Estás seguro que quieres eliminar este tutor de empresa?')) {
                                document.getElementById('delete-form-tutor-empresa-' + id).submit();
                            }
                        }
                    </script>
                </div>
            @endforeach

            <!-- Add Tutor Empresa -->
            <div id="add-display-tutor-empresa-{{ $index }}">
                <div class="mt-6 bg-white border border-blue rounded-lg py-2 pr-3 pl-7 flex justify-between items-center">
                    <p class="text-blue font-semibold">Tutor de Empresa</p>
                    <button 
                        type="button" 
                        data-target="tutor-empresa-{{ $index }}"
                        class="add-btn-tutor-empresa px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80">
                        Añadir +
                    </button>
                </div>
            </div>

            <!-- Form Add Tutor de Empresa -->
            <div id="add-form-tutor-empresa-{{ $index }}" class="hidden mt-6 bg-white border border-blue rounded-lg px-7 py-4 relative">
                <h3 class="text-md font-semibold text-blue mb-8">Añadir Tutor de Empresa</h3>
                <form method="POST" action="{{ route('tutor-empresa.add', $practica->id) }}" class="grid md:grid-cols-3 gap-6 mt-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="dni" value="DNI <span class='text-red-500'>*</span>" />
                        <x-text-input-light id="dni" name="dni" required />
                    </div>
                    
                    <div>
                        <x-input-label for="nombre" value="Nombre <span class='text-red-500'>*</span>" />
                        <x-text-input-light id="nombre" name="nombre" required />
                    </div>
                    
                    <div>
                        <x-input-label for="apellido" value="Apellido <span class='text-red-500'>*</span>" />
                        <x-text-input-light id="apellido" name="apellido" required />
                    </div>
                    
                    <div>
                        <x-input-label for="telefono" value="Teléfono" />
                        <x-text-input-light id="telefono" name="telefono" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input-light id="email" name="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <div class="md:col-span-3 flex justify-end gap-6">
                        <button type="button" class="cancel-add-btn-tutor-empresa" data-target="tutor-empresa-{{ $index }}">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                            Añadir
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Practica Edit Mode (Hidden by default) -->
        <div id="edit-practica-{{ $index }}" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-8">Editar Practica</h3>
            <form method="POST" action="{{ route('practica.update', $practica->id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')
                
                <div class="md:col-span-1 space-y-4">

                    <div>
                        <x-input-label-light for="cicloFormativo-{{ $index }}" value="Ciclo Formativo" />
                        <x-select-input-light name="cicloFormativo" id="cicloFormativo-{{ $index }}" class="mt-1 block w-full">
                            <option value="daw">Desarrollo de Aplicaciones Web</option>
                            <option value="asix">Administración de Sistemas Informáticos</option>
                            <option value="dam">Desarrollo de Aplicaciones Multiplataforma</option>
                            <option value="marketing">Marketing Digital</option>
                        </x-select-input-light>
                    </div>

                    <div>
                        <x-input-label for="periodoFrom-{{ $index }}" value="Periodo From" />
                        <x-text-input-light type="date" id="periodoFrom-{{ $index }}" name="periodoFrom" value="{{ \Carbon\Carbon::parse($practica->periodoFrom)->format('Y-m-d') }}" />
                    </div>

                    <!-- <div>
                        <x-input-label for="horarioFrom-{{ $index }}" value="Horario From" />
                        <x-text-input-light id="horarioFrom-{{ $index }}" name="horarioFrom" value="{{ $practica->horarioFrom }}" />
                    </div> -->

                    <!-- Horario From -->
                    <div>
                        <x-input-label-light for="horarioFrom-{{ $index }}" :value="__('Horario From')" />
                        <x-select-input-light name="horarioFrom" id="horarioFrom-{{ $index }}" class="mt-1 block w-full">
                            {{ $is30 = false }}
                            @for($hora = 0; $hora <= 24; $hora++)
                                {{ $loop = 2 }}
                                @while ($loop) 
                                    @if ($hora == 10)
                                        <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}" selected="selected">
                                            {{ $hora }}:{{ $is30 && $loop == 2 ? '30' : '00' }}
                                        </option>
                                    @else
                                        <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}">
                                            {{ $hora }}:{{ $is30 ? '30' : '00' }}
                                        </option>
                                    @endif
                                    {{ $is30 ? $is30 = false : $is30 = true }}
                                    {{ $loop-- }}
                                @endwhile
                            @endfor
                        </x-select-input-light>
                    </div>
                </div>
                
                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="numPlazasAsignadas-{{ $index }}" value="Numero de Plazas Asignadas" />
                        <x-text-input-light type="number" id="numPlazasAsignadas-{{ $index }}" name="numPlazasAsignadas" value="{{ $practica->numPlazasAsignadas }}" min=0 />
                    </div>

                    <div>
                        <x-input-label for="periodoTo-{{ $index }}" value="Periodo To" />
                        <x-text-input-light type="date" id="periodoTo-{{ $index }}" name="periodoTo" value="{{ \Carbon\Carbon::parse($practica->periodoTo)->format('Y-m-d') }}"  />
                    </div>
                    
                    <!-- <div>
                        <x-input-label for="horarioTo-{{ $index }}" value="Horario To" />
                        <x-text-input-light id="horarioTo-{{ $index }}" name="horarioTo" value="{{ $practica->horarioTo }}" />
                    </div> -->

                    <!-- Horario To -->
                    <div>
                        <x-input-label-light for="horarioTo-{{ $index }}" :value="__('Horario To')" />
                        <x-select-input-light name="horarioTo" id="horarioTo-{{ $index }}" class="mt-1 block w-full">
                            {{ $is30 = false }}
                            @for($hora = 0; $hora <= 23; $hora++)
                                {{ $loop = 2 }}
                                @while ($loop) 
                                    @if ($hora == 14)
                                        <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}" selected="selected">
                                            {{ $hora }}:{{ $is30 && $loop == 2 ? '30' : '00' }}
                                        </option>
                                    @else
                                        <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}">
                                            {{ $hora }}:{{ $is30 ? '30' : '00' }}
                                        </option>
                                    @endif
                                    {{ $is30 ? $is30 = false : $is30 = true }}
                                    {{ $loop-- }}
                                @endwhile
                            @endfor
                        </x-select-input-light>
                    </div>
                </div>

                <!-- <div>
                    <x-input-label for="cursoAcademico-{{ $index }}" value="Curso Academico" />
                    <x-text-input-light id="cursoAcademico-{{ $index }}" name="cursoAcademico" value="{{ $practica->cursoAcademico }}" />
                </div> -->
                <div>
                    <x-input-label-light for="cursoAcademico-{{ $index }}" :value="__('Curso Academico')" />
                    <x-select-input-light name="cursoAcademico" id="cursoAcademico-{{ $index }}" class="mt-1 block w-full">
                        <?php
                            $currentYear = date('Y');
                        ?>
                        @for($year = date('Y') + 1; $year >= ($currentYear - 1); $year--)
                            @if ($year == $currentYear)
                                <option value="{{ $year }}/{{ $year+1 }}" selected="selected">
                                    {{ $year }}/{{ $year+1 }}
                                </option>
                            @else
                                <option value="{{ $year }}/{{ $year+1 }}">
                                    {{ $year }}/{{ $year+1 }}
                                </option>
                            @endif
                        @endfor
                    </x-select-input-light>
                </div>

                <div class="md:col-span-2 space-y-4">
                    <!-- <div>
                        <x-input-label for="convenioMarco-{{ $index }}" value="Convenio Marco" />
                        <x-text-input-light id="convenioMarco-{{ $index }}" name="convenioMarco" value="{{ $practica->convenioMarco }}" />
                    </div> -->

                    <!-- Convenio Marco -->
                    <div>
                        <x-input-label-light for="convenioMarco-{{ $index }}" :value="__('Convenio Marco')" />
                        <x-select-input-light name="convenioMarco" id="convenioMarco-{{ $index }}" class="mt-1 block w-full">
                            <option value="ceac">Convenio Marco CEAC</option>
                            <option value="qbid">Convenio Marco qbid</option>
                        </x-select-input-light>
                    </div>
                </div>

                <div class="md:col-span-1 space-y-4">
                    <!-- <div>
                        <x-input-label for="usoLogos-{{ $index }}" value="Uso Logos" />
                        <x-text-input-light id="usoLogos-{{ $index }}" name="usoLogos" value="{{ $practica->usoLogos }}" />
                    </div> -->

                    <!-- Uso Logos -->
                    <div>
                        <x-input-label-light for="usoLogos-{{ $index }}" :value="__('Uso Logos')" />
                        <x-select-input-light name="usoLogos" id="usoLogos-{{ $index }}" class="mt-1 block w-full">
                            <option value="si">Si</option>
                            <option value="no">No</option>
                            <option value="autorizacion">Autorización previa</option>
                        </x-select-input-light>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <x-input-label for="observaciones-{{ $index }}" value="Observaciones" />
                    <textarea id="observaciones" name="observaciones" rows="3" class="block w-full border-gray-700 bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $practica->observaciones }}</textarea>
                </div>
                
                <div class="md:col-span-3 flex justify-between gap-4 mt-4">
                    <button type="button" onclick="confirmDeletePractica({{ $practica->id }})" class="bg-red-500 text-white px-4 py-2 rounded">
                        Eliminar
                    </button>

                    <div class="flex gap-6">
                        <button type="button" class="cancel-edit-btn" data-target="practica-{{ $index }}">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>

            <form id="delete-form-practica-{{ $practica->id }}" method="POST" action="{{ route('practica.delete', $practica->id) }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <script>
                function confirmDeletePractica(id) {
                    if (confirm('¿Estás seguro que quieres eliminar esta practica?')) {
                        document.getElementById('delete-form-practica-'+id).submit();
                    }
                }
            </script>
        </div>
    </div>
    @endforeach

    <div>
        <!-- Display Add -->
        <div id="add-display-practica" class="bg-white_dull flex justify-between items-center py-3 px-6 rounded-xl border-l-4 border-blue shadow-sm relative">
            <h3 class="text-xl font-semibold text-blue">Practica</h3>
            <button 
                id="add-btn-practica"
                type="button" 
                class="px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80">
                Añadir +
            </button>
        </div>

        <!-- Form Add -->
        <div id="add-form-practica" class="hidden bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
            <h3 class="text-xl font-semibold text-blue mb-8">Añadir Practica</h3>
            <form method="POST" action="{{ route('practica.add', $id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')
                
                <!-- Ciclo Formativo -->
                <!-- TODO: Multiple Selection -->
                <div>
                    <x-input-label-light for="cicloFormativo" :value="__('Ciclo/s Formativo/s')" />
                    <x-select-input-light name="cicloFormativo" id="cicloFormativo" class="mt-1 block w-full">
                        <option value="daw">Desarrollo de Aplicaciones Web</option>
                        <option value="asix">Administración de Sistemas Informáticos</option>
                        <option value="dam">Desarrollo de Aplicaciones Multiplataforma</option>
                        <option value="marketing">Marketing Digital</option>
                    </x-select-input-light>
                </div>

                <!-- Curso Academico -->
                <!-- TODO: Multiple Selection -->
                <div>
                    <x-input-label-light for="cursoAcademico" :value="__('Curso Academico')" />
                    <x-select-input-light name="cursoAcademico" id="cursoAcademico" class="mt-1 block w-full">
                        <?php
                            $currentYear = date('Y');
                        ?>
                        @for($year = date('Y') + 1; $year >= ($currentYear - 1); $year--)
                            @if ($year == $currentYear)
                                <option value="{{ $year }}/{{ $year+1 }}" selected="selected">
                                    {{ $year }}/{{ $year+1 }}
                                </option>
                            @else
                                <option value="{{ $year }}/{{ $year+1 }}">
                                    {{ $year }}/{{ $year+1 }}
                                </option>
                            @endif
                        @endfor
                    </x-select-input-light>
                    <x-input-error :messages="$errors->get('cursoAcademico')" class="mt-2" />
                </div>

                <!-- Periodo From -->
                <div>
                    <x-input-label-light for="periodoFrom" :value="__('Periodo From')" />
                    <x-text-input-light type="date" value="{{ date('Y-m-d') }}" id="periodoFrom" name="periodoFrom" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('periodoFrom')" class="mt-2" />
                </div>

                <!-- Periodo To -->
                <div>
                    <x-input-label-light for="periodoTo" :value="__('Periodo To')" />
                    <x-text-input-light type="date" value="{{ date('Y-m-d') }}" id="periodoTo" name="periodoTo" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('periodoTo')" class="mt-2" />
                </div>

                <!-- Horario From -->
                <div>
                    <x-input-label-light for="horarioFrom" :value="__('Horario From')" />
                    <x-select-input-light name="horarioFrom" id="horarioFrom" class="mt-1 block w-full">
                        {{ $is30 = false }}
                        @for($hora = 0; $hora <= 24; $hora++)
                            {{ $loop = 2 }}
                            @while ($loop) 
                                @if ($hora == 10)
                                    <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}" selected="selected">
                                        {{ $hora }}:{{ $is30 && $loop == 2 ? '30' : '00' }}
                                    </option>
                                @else
                                    <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}">
                                        {{ $hora }}:{{ $is30 ? '30' : '00' }}
                                    </option>
                                @endif
                                {{ $is30 ? $is30 = false : $is30 = true }}
                                {{ $loop-- }}
                            @endwhile
                        @endfor
                    </x-select-input-light>
                </div>

                <!-- Horario To -->
                <div>
                    <x-input-label-light for="horarioTo" :value="__('Horario To')" />
                    <x-select-input-light name="horarioTo" id="horarioTo" class="mt-1 block w-full">
                        {{ $is30 = false }}
                        @for($hora = 0; $hora <= 23; $hora++)
                            {{ $loop = 2 }}
                            @while ($loop) 
                                @if ($hora == 14)
                                    <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}" selected="selected">
                                        {{ $hora }}:{{ $is30 && $loop == 2 ? '30' : '00' }}
                                    </option>
                                @else
                                    <option value="{{ $hora }}:{{ $is30 ? '30' : '00' }}">
                                        {{ $hora }}:{{ $is30 ? '30' : '00' }}
                                    </option>
                                @endif
                                {{ $is30 ? $is30 = false : $is30 = true }}
                                {{ $loop-- }}
                            @endwhile
                        @endfor
                    </x-select-input-light>
                </div>

                <!-- Convenio Marco -->
                <div>
                    <x-input-label-light for="convenioMarco" :value="__('Convenio Marco')" />
                    <x-select-input-light name="convenioMarco" id="convenioMarco" class="mt-1 block w-full">
                        <option value="ceac">Convenio Marco CEAC</option>
                        <option value="qbid">Convenio Marco qbid</option>
                    </x-select-input-light>
                </div>

                <!-- Uso Logos -->
                <div>
                    <x-input-label-light for="usoLogos" :value="__('Uso Logos')" />
                    <x-select-input-light name="usoLogos" id="usoLogos" class="mt-1 block w-full">
                        <option value="si">Si</option>
                        <option value="no">No</option>
                        <option value="autorizacion">Autorización previa</option>
                    </x-select-input-light>
                </div>

                <!-- Número de Plazas Asignadas -->
                <div>
                    <x-input-label-light for="numPlazasAsignadas" :value="__('Número de Plazas Asignadas')" />
                    <x-text-input-light type="number" value='0' min="0" max="100" id="numPlazasAsignadas" name="numPlazasAsignadas" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('numPlazasAsignadas')" class="mt-2" />
                </div>

                <!-- Observaciones -->
                <div>
                    <x-input-label-light for="observaciones" :value="__('Observaciones')" />
                    <textarea id="observaciones" name="observaciones" rows="3" class="block w-full border-gray-700 bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                    <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
                </div>
                
                <div>
                    <x-input-label for="telefono" value="Teléfono" />
                    <x-text-input-light id="telefono" name="telefono" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>
                
                <div class="md:col-span-3 flex justify-end gap-6">
                    <button type="button" id="cancel-add-btn-practica">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                        Añadir
                    </button>
                </div>
            </form>
        </div>
    </div>
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

        // Add button
        document.getElementById('add-btn-practica').addEventListener('click', function() {
            document.getElementById('add-display-practica').classList.add('hidden');
            document.getElementById('add-form-practica').classList.remove('hidden');
        });
        // Cancel Add Button 
        document.getElementById('cancel-add-btn-practica').addEventListener('click', function() {
            document.getElementById('add-display-practica').classList.remove('hidden');
            document.getElementById('add-form-practica').classList.add('hidden');
        });

        // Add button TutorA
        document.querySelectorAll('.add-btn-tutor').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`add-display-${target}`).classList.add('hidden');
                document.getElementById(`add-form-${target}`).classList.remove('hidden');
            });
        });
        // Cancel Add Button TutorA
        document.querySelectorAll('.cancel-add-btn-tutor').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`add-display-${target}`).classList.remove('hidden');
                document.getElementById(`add-form-${target}`).classList.add('hidden');
            });
        });

        // Add button TutorE
        document.querySelectorAll('.add-btn-tutor-empresa').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`add-display-${target}`).classList.add('hidden');
                document.getElementById(`add-form-${target}`).classList.remove('hidden');
            });
        });
        // Cancel Add Button TutorE
        document.querySelectorAll('.cancel-add-btn-tutor-empresa').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`add-display-${target}`).classList.remove('hidden');
                document.getElementById(`add-form-${target}`).classList.add('hidden');
            });
        });
    });
</script>