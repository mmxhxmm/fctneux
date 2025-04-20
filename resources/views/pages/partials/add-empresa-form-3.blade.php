<section>
    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Añadir Centro Trabajo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Aquí se introducen los datos del Centro Trabajo y el de la Persona Contacto.') }}
        </p>
    </header>  -->
    <form method="POST" id="form" action="{{ route('store-empresa-3') }}" class="min-h-[30em] mt-6 space-y-6">
        @csrf <!-- CSRF token for security -->

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Práctica') }}
            <a>
                <x-primary-nonsubmit-button type="button" id="add_section_button_1">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>
        <div id="practica_wrapper">
            <div id="practica" >
                <!-- Nombre -->
                <!-- <div>
                    <x-input-label-light for="nombre" :value="__('Título de la tarea')" />
                    <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" autocomplete="off" />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                </div> -->

                <!-- Ciclo Formativo -->
                <!-- TODO: Multiple Selection -->
                <div class="grid grid-cols-[52%_17%_25%] gap-6 mb-6">
                    <div>
                        <x-input-label-light for="cicloFormativo" :value="__('Ciclo/s Formativo/s')" />
                        <x-select-input name="cicloFormativo" id="cicloFormativo" class="mt-1 block w-full">
                            <option value="daw">Desarrollo de Aplicaciones Web</option>
                            <option value="asix">Administración de Sistemas Informáticos</option>
                            <option value="dam">Desarrollo de Aplicaciones Multiplataforma</option>
                            <option value="marketing">Marketing Digital</option>
                        </x-select-input>
                    </div>

                    <!-- Curso Academico -->
                    <!-- TODO: Multiple Selection -->
                    <div>
                        <x-input-label-light for="cursoAcademico" :value="__('Curso Academico')" />
                        <x-select-input name="cursoAcademico" id="cursoAcademico" class="mt-1 block w-full">
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
                        </x-select-input>
                        <x-input-error :messages="$errors->get('cursoAcademico')" class="mt-2" />
                    </div>

                    <!-- Número de Plazas Asignadas -->
                    <div>
                        <x-input-label-light for="numPlazasAsignadas" :value="__('Número de Plazas Asignadas')" />
                        <x-text-input type="number" value='0' min="0" max="100" id="numPlazasAsignadas" name="numPlazasAsignadas" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('numPlazasAsignadas')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-6 mb-6">
                    <!-- Periodo From -->
                    <div>
                        <x-input-label-light for="periodoFrom" :value="__('Periodo From')" />
                        <x-text-input type="date" value="{{ date('Y-m-d') }}" id="periodoFrom" name="periodoFrom" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('periodoFrom')" class="mt-2" />
                    </div>

                    <!-- Periodo To -->
                    <div>
                        <x-input-label-light for="periodoTo" :value="__('Periodo To')" />
                        <x-text-input type="date" value="{{ date('Y-m-d') }}" id="periodoTo" name="periodoTo" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('periodoTo')" class="mt-2" />
                    </div>

                    <!-- Horario From -->
                    <div>
                        <x-input-label-light for="horarioFrom" :value="__('Horario From')" />
                        <x-select-input name="horarioFrom" id="horarioFrom" class="mt-1 block w-full">
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
                        </x-select-input>
                    </div>

                    <!-- Horario To -->
                    <div>
                        <x-input-label-light for="horarioTo" :value="__('Horario To')" />
                        <x-select-input name="horarioTo" id="horarioTo" class="mt-1 block w-full">
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
                        </x-select-input>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6 mb-6">
                        <!-- Convenio Marco -->
                        <div>
                            <x-input-label-light for="convenioMarco" :value="__('Convenio Marco')" />
                            <x-select-input name="convenioMarco" id="convenioMarco" class="mt-1 block w-full">
                                <option value="ceac">Convenio Marco CEAC</option>
                                <option value="qbid">Convenio Marco qbid</option>
                            </x-select-input>
                        </div>

                        <!-- Uso Logos -->
                        <div>
                            <x-input-label-light for="usoLogos" :value="__('Uso Logos')" />
                            <x-select-input name="usoLogos" id="usoLogos" class="mt-1 block w-full">
                                <option value="si">Si</option>
                                <option value="no">No</option>
                                <option value="autorizacion">Autorización previa</option>
                            </x-select-input>
                        </div>

                        <!-- Observaciones -->
                        <div>
                            <x-input-label-light for="observaciones" :value="__('Observaciones')" />
                            <textarea id="observaciones" name="observaciones" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
                        </div>
                </div>
            </div>
        </div>
        <!-- Hidden template for cloning -->
        <template id="practica_template">
            <details class="practica-section bg-white dark:bg-gray-900 border border-blue rounded-lg p-4 shadow-sm mb-6" open>
                <summary class="text-lg font-medium text-gray-900 dark:text-gray-100 cursor-pointer flex justify-between items-center">
                    <span class="practica-title-label">Práctica</span>
                    <button type="button" class="remove-practica text-red-500 hover:text-red-700 text-sm ml-4">❌</button>
                </summary>

                <div class="grid grid-cols-[52%_17%_25%] gap-6 my-6">
                    <!-- Nombre -->
                    <!-- <div>
                        <x-input-label-light for="nombre" :value="__('Título de la tarea')" />
                        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" autocomplete="off" />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div> -->

                    <!-- Ciclo Formativo -->
                    <!-- TODO: Multiple Selection -->
                    <div>
                        <x-input-label-light for="cicloFormativo" :value="__('Ciclo/s Formativo/s')" />
                        <x-select-input name="cicloFormativo" id="cicloFormativo" class="mt-1 block w-full">
                            <option value="daw">Desarrollo de Aplicaciones Web</option>
                            <option value="asix">Administración de Sistemas Informáticos</option>
                            <option value="dam">Desarrollo de Aplicaciones Multiplataforma</option>
                            <option value="marketing">Marketing Digital</option>
                        </x-select-input>
                    </div>

                    <!-- Curso Academico -->
                    <!-- TODO: Multiple Selection -->
                    <div>
                        <x-input-label-light for="cursoAcademico" :value="__('Curso Academico')" />
                        <x-select-input name="cursoAcademico" id="cursoAcademico" class="mt-1 block w-full">
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
                        </x-select-input>
                        <x-input-error :messages="$errors->get('cursoAcademico')" class="mt-2" />
                    </div>

                    <!-- Número de Plazas Asignadas -->
                    <div>
                        <x-input-label-light for="numPlazasAsignadas" :value="__('Número de Plazas Asignadas')" />
                        <x-text-input type="number" value='0' min="0" max="100" id="numPlazasAsignadas" name="numPlazasAsignadas" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('numPlazasAsignadas')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-6 mb-6">
                    <!-- Periodo From -->
                    <div>
                        <x-input-label-light for="periodoFrom" :value="__('Periodo From')" />
                        <x-text-input type="date" value="{{ date('Y-m-d') }}" id="periodoFrom" name="periodoFrom" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('periodoFrom')" class="mt-2" />
                    </div>

                    <!-- Periodo To -->
                    <div>
                        <x-input-label-light for="periodoTo" :value="__('Periodo To')" />
                        <x-text-input type="date" value="{{ date('Y-m-d') }}" id="periodoTo" name="periodoTo" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('periodoTo')" class="mt-2" />
                    </div>

                    <!-- Horario From -->
                    <div>
                        <x-input-label-light for="horarioFrom" :value="__('Horario From')" />
                        <x-select-input name="horarioFrom" id="horarioFrom" class="mt-1 block w-full">
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
                        </x-select-input>
                    </div>

                    <!-- Horario To -->
                    <div>
                        <x-input-label-light for="horarioTo" :value="__('Horario To')" />
                        <x-select-input name="horarioTo" id="horarioTo" class="mt-1 block w-full">
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
                        </x-select-input>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-6 mb-6">
                        <!-- Convenio Marco -->
                        <div>
                            <x-input-label-light for="convenioMarco" :value="__('Convenio Marco')" />
                            <x-select-input name="convenioMarco" id="convenioMarco" class="mt-1 block w-full">
                                <option value="ceac">Convenio Marco CEAC</option>
                                <option value="qbid">Convenio Marco qbid</option>
                            </x-select-input>
                        </div>

                        <!-- Uso Logos -->
                        <div>
                            <x-input-label-light for="usoLogos" :value="__('Uso Logos')" />
                            <x-select-input name="usoLogos" id="usoLogos" class="mt-1 block w-full">
                                <option value="si">Si</option>
                                <option value="no">No</option>
                                <option value="autorizacion">Autorización previa</option>
                            </x-select-input>
                        </div>

                        <!-- Observaciones -->
                        <div>
                            <x-input-label-light for="observaciones" :value="__('Observaciones')" />
                            <textarea id="observaciones" name="observaciones" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                            <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
                        </div>
                </div>
            </details>
        </template>


        <hr>

        <div id="header_tutor"></div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Tutor') }}
            <a href="#header_tutor">
                <x-primary-nonsubmit-button type="button" id="add_section_button_2">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <div id="tutor_wrapper">
            <div id="tutor">
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <!-- DNI -->
                    <div>
                        <x-input-label-light for="tutor_dni" :value="__('DNI/NIE <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutor_dni" name="tutor_dni" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                        <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div>
                        <x-input-label-light for="tutor_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutor_nombre" name="tutor_nombre" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Apellido -->
                    <div>
                        <x-input-label-light for="tutor_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutor_apellido" name="tutor_apellido" type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Telefono -->
                    <div>
                        <x-input-label-light for="tutor_telefono" :value="__('Teléfono')" />
                        <x-text-input id="tutor_telefono" name="tutor_telefono" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label-light for="tutor_email" :value="__('Email')" />
                        <x-text-input id="tutor_email" name="tutor_email" type="text" class="mt-1 block w-full" autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Hidden template for cloning -->
        <template id="tutor_template">
            <details class="tutor-section bg-white mt-6 dark:bg-gray-900 border border-blue rounded-lg p-4 shadow-sm mb-6" open>
                <summary class="text-lg font-medium text-gray-900 dark:text-gray-100 cursor-pointer flex justify-between items-center">
                    <span class="tutor-title-label">Tutor</span>
                    <button type="button" class="remove-tutor text-red-500 hover:text-red-700 text-sm ml-4">❌</button>
                </summary>

                <div class="grid grid-cols-3 gap-6 my-6">
                    <!-- DNI -->
                    <div>
                        <x-input-label-light for="tutor_dni" :value="__('DNI/NIE <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutor_dni" name="tutor_dni" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                        <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div>
                        <x-input-label-light for="tutor_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutor_nombre" name="tutor_nombre" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Apellido -->
                    <div>
                        <x-input-label-light for="tutor_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutor_apellido" name="tutor_apellido" type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Telefono -->
                    <div>
                        <x-input-label-light for="tutor_telefono" :value="__('Teléfono')" />
                        <x-text-input id="tutor_telefono" name="tutor_telefono" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label-light for="tutor_email" :value="__('Email')" />
                        <x-text-input id="tutor_email" name="tutor_email" type="text" class="mt-1 block w-full" autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
            </details>
        </template>
        
        <hr>

        <div id="header_tutorEmpresa"></div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Tutor Empresa') }}
            <a href="#header_tutorEmpresa">
                <x-primary-nonsubmit-button type="button" id="add_section_button_3">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>
        <div id="tutorEmpresa_wrapper">
            <div id="tutorEmpresa" >
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <!-- DNI -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_dni" :value="__('DNI/NIE <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutorEmpresa_dni" name="tutorEmpresa_dni" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                        <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutorEmpresa_nombre" name="tutorEmpresa_nombre" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Apellido -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutorEmpresa_apellido" name="tutorEmpresa_apellido" type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Telefono -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_telefono" :value="__('Teléfono')" />
                        <x-text-input id="tutorEmpresa_telefono" name="tutorEmpresa_telefono" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_email" :value="__('Email')" />
                        <x-text-input id="tutorEmpresa_email" name="tutorEmpresa_email" type="text" class="mt-1 block w-full" autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <!-- Hidden template for cloning -->
        <template id="tutorEmpresa_template">
            <details class="tutor-empresa-section bg-white mt-6 dark:bg-gray-900 border border-blue rounded-lg p-4 shadow-sm mb-6" open>
                <summary class="text-lg font-medium text-gray-900 dark:text-gray-100 cursor-pointer flex justify-between items-center">
                    <span class="tutor-empresa-title-label">Tutor Empresa</span>
                    <button type="button" class="remove-tutor-empresa text-red-500 hover:text-red-700 text-sm ml-4">❌</button>
                </summary>

                <div class="grid grid-cols-3 gap-6 my-6">
                    <!-- DNI -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_dni" :value="__('DNI/NIE <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutorEmpresa_dni" name="tutorEmpresa_dni" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                        <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutorEmpresa_nombre" name="tutorEmpresa_nombre" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Apellido -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="tutorEmpresa_apellido" name="tutorEmpresa_apellido" type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <!-- Telefono -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_telefono" :value="__('Teléfono')" />
                        <x-text-input id="tutorEmpresa_telefono" name="tutorEmpresa_telefono" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label-light for="tutorEmpresa_email" :value="__('Email')" />
                        <x-text-input id="tutorEmpresa_email" name="tutorEmpresa_email" type="text" class="mt-1 block w-full" autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
            </details>
        </template>


        <!-- Bottom button and status bar -->
        <x-form-buttons :currentRoute="route('empresa-form-3')" />
    </form>
</section>
<script>
            function updatePracticaTitles() {
                const sections = document.querySelectorAll('.practica-section .practica-title-label');
                sections.forEach((label, index) => {
                    label.textContent = `Práctica #${index + 2}`;
                });
            }

            document.getElementById('add_section_button_1').addEventListener('click', function () {
                const wrapper = document.getElementById('practica_wrapper');
                const template = document.getElementById('practica_template');
                const clone = template.content.cloneNode(true);
                wrapper.appendChild(clone);
                updatePracticaTitles();
            });

            document.getElementById('practica_wrapper').addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-practica')) {
                    const section = e.target.closest('.practica-section');
                    if (section) {
                        section.remove();
                        updatePracticaTitles();
                    }
                }
            });

            document.addEventListener('DOMContentLoaded', updatePracticaTitles);

            // Tutor
            function updateTutorTitles() {
                const sections = document.querySelectorAll('.tutor-section .tutor-title-label');
                sections.forEach((label, index) => {
                    label.textContent = `Tutor #${index + 2}`;
                });
            }

            document.getElementById('add_section_button_2').addEventListener('click', function () {
                const wrapper = document.getElementById('tutor_wrapper');
                const template = document.getElementById('tutor_template');
                const clone = template.content.cloneNode(true);
                wrapper.appendChild(clone);
                updateTutorTitles();
            });

            document.getElementById('tutor_wrapper').addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-tutor')) {
                    const section = e.target.closest('.tutor-section');
                    if (section) {
                        section.remove();
                        updateTutorTitles();
                    }
                }
            });

            document.addEventListener('DOMContentLoaded', updateTutorTitles);

            //  Tutor Empresa

            function updateTutorEmpresaTitles() {
                const sections = document.querySelectorAll('.tutor-empresa-section .tutor-empresa-title-label');
                sections.forEach((label, index) => {
                    label.textContent = `Tutor Empresa #${index + 2}`;
                });
            }

            document.getElementById('add_section_button_3').addEventListener('click', function () {
                const wrapper = document.getElementById('tutorEmpresa_wrapper');
                const template = document.getElementById('tutorEmpresa_template');
                const clone = template.content.cloneNode(true);
                wrapper.appendChild(clone);
                updateTutorEmpresaTitles();
            });

            document.getElementById('tutorEmpresa_wrapper').addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-tutor-empresa')) {
                    const section = e.target.closest('.tutor-empresa-section');
                    if (section) {
                        section.remove();
                        updateTutorEmpresaTitles();
                    }
                }
            });

            document.addEventListener('DOMContentLoaded', updateTutorEmpresaTitles);
</script>