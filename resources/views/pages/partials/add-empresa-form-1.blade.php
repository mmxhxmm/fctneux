<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Añadir Nueva Empresa') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Aquí se introducen los datos de la Empresa y el del Responsable Convenio.') }}
        </p>
    </header>

    <form method="POST" id="form" action="{{ route('store-empresa-1') }}" class="mt-6 space-y-6">
        @csrf <!-- CSRF token for security -->

        <!-- CIF -->
        <div>
            <x-input-label for="cif" :value="__('CIF <span class=\'text-red-500\'>*</span>')" />
            <x-text-input id="cif" name="cif" type="text" value="{{ old('cif', session('empresa_draft')?->cif) }}"  class="mt-1 block w-full" autocomplete="cif" required />
            <x-input-error :messages="$errors->get('cif')" class="mt-2" />
        </div>

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
            <x-text-input id="nombre" name="nombre" type="text" value="{{ old('nombre', session('empresa_draft')?->nombre) }}" class="mt-1 block w-full" autocomplete="nombre" required />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Colaboración -->
        <div>
            <x-input-label for="colaboracion" :value="__('Colaboración')" />
            <x-select-input name="colaboracion" id="colaboracion" class="mt-1 block w-full">
                <x-session-option 
                    value="prospeccion" 
                    :selectedValue="old('colaboracion', session('empresa_draft')?->colaboracion)" 
                    label="Prospección"
                />
                <x-session-option 
                    value="colaboracion" 
                    :selectedValue="old('colaboracion', session('empresa_draft')?->colaboracion)" 
                    label="Colaboración"
                />
                <x-session-option 
                    value="inactiva" 
                    :selectedValue="old('colaboracion', session('empresa_draft')?->colaboracion)" 
                    label="Inactiva"
                />
            </x-select-input>
        </div>

        <!-- Gestiones -->
        <div>
            <x-input-label for="gestiones" :value="__('Gestiones')" />

            <div id="prospeccion-options" style="display: none;">
                <x-select-input name="gestiones_prospeccion" id="gestiones" class="mt-1 block w-full">
                    <x-session-option 
                        value="primer_contacto" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="P - Primer contacto"
                    />
                    <x-session-option 
                        value="pendente_respuesta" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="P - Pendente respuesta"
                    />
                    <x-session-option 
                        value="volver_contactar" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="P - Volver a contactar"
                    />
                    <x-session-option 
                        value="no_acogen_alumnado" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="P - No acogen alumnado"
                    />
                </x-select-input>
            </div>

            <div id="colaboracion-options" style="display: none;">
                <x-select-input name="gestiones_colaboracion" id="gestiones" class="mt-1 block w-full">
                    <x-session-option 
                        value="pendiente_firma_convenio" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="C - Pendiente firma Convenio"
                    />
                    <x-session-option 
                        value="plazas_conseguidas" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="C - Plazas conseguidas"
                    />
                    <x-session-option 
                        value="solicitud_plazas" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="C - Solicitud plazas"
                    />
                </x-select-input>
            </div>

            <div id="inactiva-options" style="display: none;">
                <x-select-input name="gestiones_inactiva" id="gestiones" class="mt-1 block w-full">
                    <x-session-option 
                        value="null" 
                        :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                        label="--"
                    />
                </x-select-input>
            </div>
        </div>

        <!-- Modalidad -->
        <div>
            <x-input-label for="modalidad" :value="__('Modalidad')" />
            <x-select-input name="modalidad" id="modalidad" class="mt-1 block w-full">
                <x-session-option 
                    value="presencial" 
                    :selectedValue="old('modalidad', session('empresa_draft')?->modalidad)" 
                    label="Presencial"
                />
                <x-session-option 
                    value="presencial" 
                    :selectedValue="old('modalidad', session('empresa_draft')?->modalidad)" 
                    label="Remoto"
                />
                <x-session-option 
                    value="semipresencial" 
                    :selectedValue="old('modalidad', session('empresa_draft')?->modalidad)" 
                    label="Semipresencial"
                />
            </x-select-input>
        </div>

        <!-- Oferta Laboral -->
        <div>
            <x-input-label for="ofertaLaboral" :value="__('Oferta Laboral')" />
            <x-select-input name="ofertaLaboral" id="ofertaLaboral" class="mt-1 block w-full">
                <x-session-option 
                    value="null" 
                    :selectedValue="old('ofertaLaboral', session('empresa_draft')?->ofertaLaboral)" 
                    label="--"
                />
                <x-session-option 
                    value="si" 
                    :selectedValue="old('ofertaLaboral', session('empresa_draft')?->ofertaLaboral)" 
                    label="Si"
                />
                <x-session-option 
                    value="no" 
                    :selectedValue="old('ofertaLaboral', session('empresa_draft')?->ofertaLaboral)" 
                    label="No"
                />
            </x-select-input>
        </div>

        <!-- Entidad -->
        <div>
            <x-input-label for="entidad" :value="__('Entidad')" />
            <x-text-input id="entidad" name="entidad" type="text" value="{{ old('entidad', session('empresa_draft')?->entidad) }}" class="mt-1 block w-full" autocomplete="entidad" />
            <x-input-error :messages="$errors->get('entidad')" class="mt-2" />
        </div>

        <!-- Ubicación -->
        <div>
            <x-input-label for="ubicacion" :value="__('Ubicación')" />
            <x-select-input name="ubicacion" id="ubicacion" value="{{ old('ubicacion', session('empresa_draft')?->ubicacion) }}" class="mt-1 block w-full">
                <x-session-option 
                    value="catalunya" 
                    :selectedValue="old('ubicacion', session('empresa_draft')?->ubicacion)" 
                    label="Cataluña"
                />
                <x-session-option 
                    value="fueraDeCatalunya" 
                    :selectedValue="old('ubicacion', session('empresa_draft')?->ubicacion)" 
                    label="Fuera de Cataluña"
                />
                <x-session-option 
                    value="fueraDeEspanya" 
                    :selectedValue="old('ubicacion', session('empresa_draft')?->ubicacion)" 
                    label="Fuera de España"
                />
            </x-select-input>
        </div>

        <!-- Municipio -->
        <div>
            <x-input-label for="municipio" :value="__('Municipio/Localidad')" />
            <x-text-input id="municipio" name="municipio" type="text" value="{{ old('municipio', session('empresa_draft')?->municipio) }}" class="mt-1 block w-full" autocomplete="municipio" />
            <x-input-error :messages="$errors->get('municipio')" class="mt-2" />
        </div>

        <!-- Dirección -->
        <div>
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" name="direccion" type="text" value="{{ old('direccion', session('empresa_draft')?->direccion) }}" class="mt-1 block w-full" autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Código Postal -->
        <div>
            <x-input-label for="codigoPostal" :value="__('Código Postal')" />
            <x-text-input id="codigoPostal" name="codigoPostal" type="text" value="{{ old('codigoPostal', session('empresa_draft')?->codigoPostal) }}" class="mt-1 block w-full" autocomplete="codigoPostal" />
            <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
        </div>

        <!-- Familia Personal -->
        <div>
            <x-input-label for="familiaPersonal" :value="__('Familia Personal')" />
            <x-select-input name="familiaPersonal" id="familiaPersonal" class="mt-1 block w-full">
                <x-session-option 
                    value="sanidad" 
                    :selectedValue="old('familiaPersonal', session('empresa_draft')?->familiaPersonal)" 
                    label="Sanidad"
                />
                <x-session-option 
                    value="informatica" 
                    :selectedValue="old('familiaPersonal', session('empresa_draft')?->familiaPersonal)" 
                    label="Informática"
                />
                <x-session-option 
                    value="hosteleria" 
                    :selectedValue="old('familiaPersonal', session('empresa_draft')?->familiaPersonal)" 
                    label="Hostelería"
                />
                <x-session-option 
                    value="marketing" 
                    :selectedValue="old('familiaPersonal', session('empresa_draft')?->familiaPersonal)" 
                    label="Marketing"
                />
            </x-select-input>
        </div>

        <!-- Observaciones -->
        <div>
            <x-input-label for="observaciones" :value="__('Observaciones')" />
            <textarea id="observaciones" name="observaciones" value="{{ old('observaciones', session('empresa_draft')?->observaciones) }}" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
            <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
        </div>

        <hr>

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Responsable Convenio') }}
            <a href="#secondary_section">
                <x-primary-nonsubmit-button type="button" id="add_section_button_1">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <div id="secondary_section" class="space-y-6" style="display:block">
            <!-- DNI -->
            <div>
                <x-input-label for="rc_dni" :value="__('DNI <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="rc_dni" name="rc_dni" value="{{ old('rc_dni', session('responsableConvenio_draft')?->dni) }}" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>

            <!-- Nombre -->
            <div>
                <x-input-label for="rc_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="rc_nombre" name="rc_nombre" value="{{ old('rc_nombre', session('responsableConvenio_draft')?->nombre) }}" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <!-- Apellido -->
            <div>
                <x-input-label for="rc_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="rc_apellido" name="rc_apellido" value="{{ old('rc_apellido', session('responsableConvenio_draft')?->apellido) }}" type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>

            <!-- Telefono -->
            <div>
                <x-input-label for="rc_telefono" :value="__('Teléfono')" />
                <x-text-input id="rc_telefono" name="rc_telefono" value="{{ old('rc_telefono', session('responsableConvenio_draft')?->telefono) }}" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="rc_email" :value="__('Email')" />
                <x-text-input id="rc_email" name="rc_email" value="{{ old('rc_email', session('responsableConvenio_draft')?->email) }}" type="text" class="mt-1 block w-full" autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Bottom button and status bar -->
        <x-form-buttons :currentRoute="route('empresa-form-1')" />
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const colaboracionSelect = document.getElementById('colaboracion');

        document.getElementById('form').addEventListener('change', function () {
            if (colaboracionSelect.value) {
                handleColaboracionChange({ target: colaboracionSelect });
            }
        });
        
        function handleColaboracionChange(event) {
            const selectedValue = event.target.value;

            const colaboracion = document.getElementById('colaboracion-options');
            const prospeccion = document.getElementById('prospeccion-options');
            const inactiva = document.getElementById('inactiva-options');

            if (selectedValue === 'prospeccion') {
                colaboracion.style.display = 'none';
                inactiva.style.display = 'none';
                prospeccion.style.display = 'block';
            } else if (selectedValue === 'colaboracion') {
                prospeccion.style.display = 'none';
                inactiva.style.display = 'none';
                colaboracion.style.display = 'block';
            } else if (selectedValue === 'inactiva') {
                prospeccion.style.display = 'none';
                colaboracion.style.display = 'none';
                inactiva.style.display = 'block';
            }
        }
        
        if (colaboracionSelect.value) {
            handleColaboracionChange({ target: colaboracionSelect });
        }
    });
</script>