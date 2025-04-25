<section>
    <div class="flex justify-between items-center">
        <!-- <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Añadir Nueva Empresa') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 ">
                {{ __('Aquí se introducen los datos de la Empresa y el del Responsable Convenio.') }}
            </p>
        </header> -->
    </div>

    <form method="POST" id="form" action="{{ route('store-empresa-1') }}" class="mt-6 space-y-6">
        @csrf <!-- CSRF token for security -->
        <div class="grid grid-cols-2 gap-6">

            <!-- CIF -->
            <div>
                <x-input-label-light for="cif" :value="__('CIF <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="cif" name="cif" type="text" value="{{ old('cif', session('empresa_draft')?->cif) }}" autocomplete="cif" required />
                <x-input-error :messages="$errors->get('cif')" class="mt-2" />
            </div>

            <!-- Nombre -->
            <div>
                <x-input-label-light for="nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="nombre" name="nombre" type="text" value="{{ old('nombre', session('empresa_draft')?->nombre) }}" class="mt-1 block w-full" autocomplete="nombre" required />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

        </div>
        <div class="grid grid-cols-3 gap-6">
            <!-- Colaboración -->
            <div>
                <x-input-label-light for="colaboracion" :value="__('Colaboración')" />
                <x-select-input name="colaboracion" id="colaboracion">
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
                <x-input-label-light for="gestiones" :value="__('Gestiones')" />

                <div id="prospeccion-options" style="display: none;">
                    <x-select-input name="gestiones_prospeccion" id="gestiones">
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
                    <x-select-input name="gestiones_colaboracion" id="gestiones">
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
                    <x-select-input name="gestiones_inactiva" id="gestiones" class="block w-full">
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
                <x-input-label-light for="modalidad" :value="__('Modalidad')" />
                <x-select-input name="modalidad" id="modalidad">
                    <x-session-option 
                        value="presencial" 
                        :selectedValue="old('modalidad', session('empresa_draft')?->modalidad)" 
                        label="Presencial"
                    />
                    <x-session-option 
                        value="remoto" 
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
                <x-input-label-light for="ofertaLaboral" :value="__('Oferta Laboral')" />
                <x-select-input name="ofertaLaboral" id="ofertaLaboral">
                    <x-session-option 
                        value="" 
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
                <x-input-label-light for="entidad" :value="__('Entidad')" />
                <x-text-input id="entidad" name="entidad" type="text" value="{{ old('entidad', session('empresa_draft')?->entidad) }}" class="mt-1 block w-full" autocomplete="entidad" />
                <x-input-error :messages="$errors->get('entidad')" class="mt-2" />
            </div>

            <!-- Familia Personal -->
            <div>
                <x-input-label-light for="familiaPersonal" :value="__('Familia Personal')" />
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

            <!-- Comunidad Autónoma -->
            <div>
                <x-input-label-light for="comunidad" :value="__('Comunidad Autónoma')" />
                <x-select-input name="comunidad" id="comunidad" 
                    class="block border border-gray-300 w-full mt-1 rounded text-gray-900"
                    data-initial-value="{{ old('comunidad', session('empresa_draft')?->comunidad ?? '') }}">
                    <option value="">Selecciona una comunidad</option>
                </x-select-input>
            </div>

            <!-- Provincia -->
            <div>
                <x-input-label-light for="provincia" :value="__('Provincia')" />
                <x-select-input name="provincia" id="provincia" 
                    class="block w-full mt-1 border border-gray-300 rounded text-gray-900"
                    data-initial-value="{{ old('provincia', session('empresa_draft')?->provincia ?? '') }}">
                    <option value="">Selecciona una provincia</option>
                </x-select-input>
            </div>

            <!-- Municipio -->
            <div>
                <x-input-label-light for="municipio" :value="__('Municipio')" />
                <x-select-input name="municipio" id="municipio" class="block w-full mt-1 border border-gray-300 rounded text-gray-900"
                data-initial-value="{{ old('municipio', session('empresa_draft')?->municipio ?? '') }}">
                    <option value="">Selecciona un municipio</option>
                </x-select-input>
            </div>

            <!-- Dirección -->
            <div>
                <x-input-label-light for="direccion" :value="__('Dirección')" />
                <x-text-input id="direccion" name="direccion" type="text" value="{{ old('direccion', session('empresa_draft')?->direccion) }}" class="mt-1 block w-full" autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
            </div>

            <!-- Código Postal -->
            <div>
                <x-input-label-light for="codigoPostal" :value="__('Código Postal')" />
                <x-text-input id="codigoPostal" name="codigoPostal" type="text" value="{{ old('codigoPostal', session('empresa_draft')?->codigoPostal) }}" class="mt-1 block w-full" autocomplete="codigoPostal" />
                <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
            </div>

            
            <!-- Observaciones -->
            <div>
                <x-input-label-light for="observaciones" :value="__('Observaciones')" />
                <textarea id="observaciones" name="observaciones" value="{{ old('observaciones', session('empresa_draft')?->observaciones) }}" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
            </div>
        </div>
        <hr>

        <!-- Responsable -->
        <h2 class="text-lg font-medium text-gray-900  flex justify-between">
            {{ __('Añadir Responsable Convenio') }}
            <x-primary-nonsubmit-button type="button" id="add_section_button_1">
                {{ __(' + ') }}
            </x-primary-nonsubmit-button>
        </h2>

        <!-- Wrapper where all Responsable Convenio forms will go -->
        <div id="responsables_wrapper"></div>

        
        <template id="responsable_template">
            <details class="responsable-section bg-white border rounded-lg p-4 shadow-sm mb-6" open>
                <summary class="text-lg font-medium text-gray-900 cursor-pointer flex justify-between items-center">
                    <span class="title-label">Responsable Convenio</span>
                    <button type="button" class="remove-section text-red-500 hover:text-red-700 text-sm ml-4">❌</button>
                </summary>
                <hr class="mt-2">

                <div class="grid grid-cols-3 gap-6 my-6"> 
                    <input type="hidden" name="responsable_count" id="responsable_count" value="0">

                    <div>
                        <x-input-label-light for="rc_dni" :value="__('DNI <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="rc_dni" name="rc_dni" value="{{ old('rc_dni', session('responsableConvenio_draft')?->dni) }}" type="text" class="mt-1 block w-full" autocomplete="dni"  />
                        <x-input-error :messages="$errors->get('rc_dni')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label-light for="rc_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="rc_nombre" name="rc_nombre" value="{{ old('rc_nombre', session('responsableConvenio_draft')?->nombre) }}" type="text" class="mt-1 block w-full" autocomplete="nombre"  />
                        <x-input-error :messages="$errors->get('rc_nombre')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label-light for="rc_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="rc_apellido" name="rc_apellido" value="{{ old('rc_apellido', session('responsableConvenio_draft')?->apellido) }}" type="text" class="mt-1 block w-full" autocomplete="apellido"  />
                        <x-input-error :messages="$errors->get('rc_apellido')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 mb-6"> 
                    <div>
                        <x-input-label-light for="rc_telefono" :value="__('Teléfono')" />
                        <x-text-input id="rc_telefono" name="rc_telefono" value="{{ old('rc_telefono', session('responsableConvenio_draft')?->telefono) }}" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                        <x-input-error :messages="$errors->get('rc_telefono')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label-light for="rc_email" :value="__('Email')" />
                        <x-text-input id="rc_email" name="rc_email" value="{{ old('rc_email', session('responsableConvenio_draft')?->email) }}" type="text" class="mt-1 block w-full" autocomplete="email" />
                        <x-input-error :messages="$errors->get('rc_email')" class="mt-2" />
                    </div>
                </div>
            </details>
        </template>

        <!-- Bottom button and status bar -->
        <x-form-buttons :currentRoute="route('empresa-form-1')" />
    </form>
</section>

<script>

    document.getElementById('form').addEventListener('submit', function (e) {
        const sections = document.querySelectorAll('.responsable-section');

        sections.forEach(section => {
            const dni = section.querySelector('[name="rc_dni"]').value.trim();
            const nombre = section.querySelector('[name="rc_nombre"]').value.trim();
            const apellido = section.querySelector('[name="rc_apellido"]').value.trim();

            if (!dni && !nombre && !apellido) {
                section.remove(); // Remove this empty responsable block
            }
        });
    });

    function updateTitles() {
    const sections = document.querySelectorAll('.responsable-section');
    document.getElementById('responsable_count').value = sections.length;

    sections.forEach((section, index) => {
        const num = index + 1;

        // Update title
        section.querySelector('.title-label').textContent = `Responsable Convenio #${num}`;

        // Update input IDs (they start duplicated from template)
        const dni = section.querySelector('[id^="rc_dni"]');
        if (dni) dni.id = `rc_dni_${num}`;

        const nombre = section.querySelector('[id^="rc_nombre"]');
        if (nombre) nombre.id = `rc_nombre_${num}`;

        const apellido = section.querySelector('[id^="rc_apellido"]');
        if (apellido) apellido.id = `rc_apellido_${num}`;

        const telefono = section.querySelector('[id^="rc_telefono"]');
        if (telefono) telefono.id = `rc_telefono_${num}`;

        const email = section.querySelector('[id^="rc_email"]');
        if (email) email.id = `rc_email_${num}`;

        // Update labels
        const labels = section.querySelectorAll('label');
        labels.forEach(label => {
            const forAttr = label.getAttribute('for');
            if (forAttr && forAttr.startsWith('rc_')) {
                label.setAttribute('for', `${forAttr}_${num}`);
            }
        });
    });
}


    document.getElementById('add_section_button_1').addEventListener('click', function () {
        const template = document.getElementById('responsable_template');
        const clone = template.content.cloneNode(true);
        const wrapper = document.getElementById('responsables_wrapper');

        // Append the new section
        wrapper.appendChild(clone);

        // Re-number everything
        updateTitles();
    });

    // Handle remove button (event delegation)
    document.getElementById('responsables_wrapper').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-section')) {
            e.preventDefault();
            const section = e.target.closest('.responsable-section');
            if (section) {
                section.remove();
                updateTitles();
            }
        }
    });

    // Initial numbering
    document.addEventListener('DOMContentLoaded', updateTitles);


    // Colaboration change
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