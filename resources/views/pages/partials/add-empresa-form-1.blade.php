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
            <x-text-input id="cif" name="cif" type="text" class="mt-1 block w-full" autocomplete="cif" required />
            <x-input-error :messages="$errors->get('cif')" class="mt-2" />
        </div>

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Colaboración -->
        <div>
            <x-input-label for="colaboracion" :value="__('Colaboración')" />
            <x-select-input name="colaboracion" id="colaboracion" class="mt-1 block w-full">
                <option value="prospeccion">Prospección</option>
                <option value="colaboracion">Colaboración</option>
                <option value="inactiva">Inactiva</option>
            </x-select-input>
        </div>

        <!-- Gestiones -->
        <div>
            <x-input-label for="gestiones" :value="__('Gestiones')" />

            <div id="prospeccion-options" style="display: none;">
                <x-select-input name="gestiones_prospeccion" id="gestiones" class="mt-1 block w-full">
                    <option value="primer_contacto">P - Primer contacto</option>
                    <option value="pendente_respuesta">P - Pendente respuesta</option>
                    <option value="volver_contactar">P - Volver a contactar</option>
                    <option value="no_acogen_alumnado">P - No acogen alumnado</option>
                </x-select-input>
            </div>

            <div id="colaboracion-options" style="display: none;">
                <x-select-input name="gestiones_colaboracion" id="gestiones" class="mt-1 block w-full">
                    <option value="pendiente_firma_convenio">C - Pendiente firma Convenio</option>
                    <option value="plazas_conseguidas">C - Plazas conseguidas</option>
                    <option value="solicitud_plazas">C - Solicitud plazas</option>
                </x-select-input>
            </div>

            <div id="inactiva-options" style="display: none;">
                <x-select-input name="gestiones_inactiva" id="gestiones" class="mt-1 block w-full">
                    <option value="null">--</option>
                </x-select-input>
            </div>
        </div>

        <!-- Modalidad -->
        <div>
            <x-input-label for="modalidad" :value="__('Modalidad')" />
            <x-select-input name="modalidad" id="modalidad" class="mt-1 block w-full">
                <option value="presencial">Presencial</option>
                <option value="remoto">Remoto</option>
                <option value="semipresencial">Semipresencial</option>
            </x-select-input>
        </div>

        <!-- Oferta Laboral -->
        <div>
            <x-input-label for="ofertaLaboral" :value="__('Oferta Laboral')" />
            <x-select-input name="ofertaLaboral" id="ofertaLaboral" class="mt-1 block w-full">
                <option value="si">Si</option>
                <option value="no">No</option>
            </x-select-input>
        </div>

        <!-- Entidad -->
        <div>
            <x-input-label for="entidad" :value="__('Entidad')" />
            <x-text-input id="entidad" name="entidad" type="text" class="mt-1 block w-full" autocomplete="entidad" />
            <x-input-error :messages="$errors->get('entidad')" class="mt-2" />
        </div>

        <!-- Ubicación -->
        <div>
            <x-input-label for="ubicacion" :value="__('Ubicación')" />
            <x-select-input name="ubicacion" id="ubicacion" class="mt-1 block w-full">
                <option value="catalunya">Cataluña</option>
                <option value="fueraDeCatalunya">Fuera de Cataluña</option>
                <option value="fueraDeEspanya">Fuera de España</option>
            </x-select-input>
        </div>

        <!-- Municipio -->
        <div>
            <x-input-label for="municipio" :value="__('Municipio/Localidad')" />
            <x-text-input id="municipio" name="municipio" type="text" class="mt-1 block w-full" autocomplete="municipio" />
            <x-input-error :messages="$errors->get('municipio')" class="mt-2" />
        </div>

        <!-- Dirección -->
        <div>
            <x-input-label for="direccion" :value="__('Dirección')" />
            <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Código Postal -->
        <div>
            <x-input-label for="codigoPostal" :value="__('Código Postal')" />
            <x-text-input id="codigoPostal" name="codigoPostal" type="text" class="mt-1 block w-full" autocomplete="codigoPostal" />
            <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
        </div>

        <!-- Familia Personal -->
        <div>
            <x-input-label for="familiaPersonal" :value="__('Familia Personal')" />
            <x-select-input name="familiaPersonal" id="familiaPersonal" class="mt-1 block w-full">
                <option value="sanidad">Sanidad</option>
                <option value="informatica">Informática</option>
                <option value="hostelería">Hostelería</option>
                <option value="marketing">Marketing</option>
            </x-select-input>
        </div>

        <!-- Observaciones -->
        <div>
            <x-input-label for="observaciones" :value="__('Observaciones')" />
            <textarea id="observaciones" name="observaciones" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
            <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
        </div>

        <hr>

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Responsable Convenio') }}
            <a href="#responsable_convenio">
                <x-primary-nonsubmit-button id="add_section_button">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <div id="responsable_convenio" class="space-y-6" style="display:block">
            <!-- DNI -->
            <div>
                <x-input-label for="rc_dni" :value="__('DNI <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="rc_dni" name="rc_dni" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>

            <!-- Nombre -->
            <div>
                <x-input-label for="rc_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="rc_nombre" name="rc_nombre" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <!-- Apellido -->
            <div>
                <x-input-label for="rc_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="rc_apellido" name="rc_apellido" type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>

            <!-- Telefono -->
            <div>
                <x-input-label for="rc_telefono" :value="__('Teléfono')" />
                <x-text-input id="rc_telefono" name="rc_telefono" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="rc_email" :value="__('Email')" />
                <x-text-input id="rc_email" name="rc_email" type="text" class="mt-1 block w-full" autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-12" id="bottom">
            <x-primary-button name="action" value="save_draft" aria-label="Guardar el Draft y salir">{{ __('Save Draft') }}</x-primary-button>
            <x-primary-button name="action" value="next_page" aria-label="Guardar y ir a la siguiente página">{{ __('Sigiente Página') }}</x-primary-button>

            <!-- Get status message -->
            @if (session('status'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ session('status') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const colaboracionSelect = document.getElementById('colaboracion');
        const form = document.getElementById('form');
        const responsableSection = document.getElementById('responsable_convenio');
        const requiredFields = responsableSection.querySelectorAll('#rc_dni, #rc_nombre, #rc_apellido');

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

        document.getElementById('add_section_button').addEventListener('click', showResponsableConvenio);
        
        showResponsableConvenio(); // Set required to false on startup
        function showResponsableConvenio() {
            if (responsableSection.style.display !== 'block') {
                // Show Area
                responsableSection.style.display = 'block';
                document.getElementById('add_section_button').textContent = " - ";
                requiredFields.forEach(function (field) {
                    field.required = true;
                    field.disabled = false;
                });
            } else {
                // Hide Area
                responsableSection.style.display = 'none';
                document.getElementById('add_section_button').textContent = " + ";
                requiredFields.forEach(function (field) {
                    field.required = false;
                    field.disabled = true;
                });
            }
        }

        document.getElementById('form').addEventListener('change', function () {
            if (colaboracionSelect.value) {
                handleColaboracionChange({ target: colaboracionSelect });
            }
        });
    });
</script>