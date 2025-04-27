<section>
    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Añadir Centro Trabajo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Aquí se introducen los datos del Centro Trabajo y el de la Persona Contacto.') }}
        </p>
    </header>  -->
    <form method="POST" id="form" action="{{ route('store-empresa-2') }}" class="min-h-[30em] mt-6 space-y-6">
        @csrf <!-- CSRF token for security -->

        <h2 class="text-lg font-medium text-gray-900 flex justify-between">
            {{ __('Añadir Centro Trabajo') }}
            <!-- TODO: CHANGE THIS TO INCLUDE PC and it doesnt work either -->
            <!-- <a>
                <x-primary-nonsubmit-button type="button" id="add_section_button_1">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a> -->
        </h2>

        <input type="hidden" name="centro_count" id="centro_count" value="0">

        <div id="centro_trabajo_wrapper">
            <div id="centro_trabajo" class="grid grid-cols-2 gap-6 mb-6">

                <!-- Dirección -->
                <div>
                    <x-input-label-light for="direccion" :value="__('Dirección')" />
                    <x-text-input id="direccion" name="direccion" value="{{ old('direccion', session('centroTrabajo_draft')?->direccion) }}" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                </div>

                <!-- Código Postal -->
                <div>
                    <x-input-label-light for="codigoPostal" :value="__('Código Postal')" />
                    <x-text-input id="codigoPostal" name="codigoPostal" maxlength="5" value="{{ old('codigoPostal', session('centroTrabajo_draft')?->codigoPostal) }}" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mb-6">
                <!-- Comunidad Autónoma -->
                <div>
                    <x-input-label-light for="comunidad" :value="__('Comunidad Autónoma')" />
                    <x-select-input name="comunidad" id="comunidad" 
                        class="block border border-gray-300 w-full mt-1 rounded text-gray-900"
                        data-initial-value="{{ old('comunidad', session('centroTrabajo_draft')?->comunidad ?? '') }}">
                        <option value="">Selecciona una comunidad</option>
                    </x-select-input>
                </div>

                <!-- Provincia -->
                <div>
                    <x-input-label-light for="provincia" :value="__('Provincia')" />
                    <x-select-input name="provincia" id="provincia" 
                        class="block w-full mt-1 border border-gray-300 rounded text-gray-900"
                        data-initial-value="{{ old('provincia', session('centroTrabajo_draft')?->provincia ?? '') }}">
                        <option value="">Selecciona una provincia</option>
                    </x-select-input>
                </div>

                <!-- Municipio -->
                <div>
                    <x-input-label-light for="municipio" :value="__('Municipio')" />
                    <x-select-input name="municipio" id="municipio" class="block w-full mt-1 border border-gray-300 rounded text-gray-900"
                    data-initial-value="{{ old('municipio', session('centroTrabajo_draft')?->municipio ?? '') }}">
                        <option value="">Selecciona un municipio</option>
                    </x-select-input>
                </div>
            </div>
        </div>
        <!-- Hidden template for cloning -->
        <template id="centro_trabajo_template">
            <details class="centro-trabajo-section bg-white border border-blue rounded-lg p-4 shadow-sm mb-6" open>
                <summary class="text-lg font-medium text-gray-900 cursor-pointer flex justify-between items-center">
                    <span class="centro-title-label">Centro de Trabajo</span>
                    <button type="button" class="remove-centro text-red-500 hover:text-red-700 text-sm ml-4">❌</button>
                </summary>

                <div class="grid grid-cols-2 gap-6 mb-6">

                <!-- Dirección -->
                <div>
                    <x-input-label-light for="direccion" :value="__('Dirección')" />
                    <x-text-input id="direccion" name="direccion" value="{{ old('direccion', session('centroTrabajo_draft')?->direccion) }}" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                </div>

                <!-- Código Postal -->
                <div>
                    <x-input-label-light for="codigoPostal" :value="__('Código Postal')" />
                    <x-text-input id="codigoPostal" name="codigoPostal" value="{{ old('codigoPostal', session('centroTrabajo_draft')?->codigoPostal) }}" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
                </div>
            </div>
            <div class="grid grid-cols-3 gap-6 mb-6">
                <!-- Comunidad Autónoma -->
                <div>
                    <x-input-label-light for="comunidad" :value="__('Comunidad Autónoma')" />
                    <x-select-input name="comunidad" id="comunidad" 
                        class="block border border-gray-300 w-full mt-1 rounded text-gray-900"
                        data-initial-value="{{ old('comunidad', session('centroTrabajo_draft')?->comunidad ?? '') }}">
                        <option value="">Selecciona una comunidad</option>
                    </x-select-input>
                </div>

                <!-- Provincia -->
                <div>
                    <x-input-label-light for="provincia" :value="__('Provincia')" />
                    <x-select-input name="provincia" id="provincia" 
                        class="block w-full mt-1 border border-gray-300 rounded text-gray-900"
                        data-initial-value="{{ old('provincia', session('centroTrabajo_draft')?->provincia ?? '') }}">
                        <option value="">Selecciona una provincia</option>
                    </x-select-input>
                </div>

                <!-- Municipio -->
                <div>
                    <x-input-label-light for="municipio" :value="__('Municipio')" />
                    <x-select-input name="municipio" id="municipio" class="block w-full mt-1 border border-gray-300 rounded text-gray-900"
                    data-initial-value="{{ old('municipio', session('centroTrabajo_draft')?->municipio ?? '') }}">
                        <option value="">Selecciona un municipio</option>
                    </x-select-input>
                </div>
            </div>
            </details>
        </template>


        <hr>

        <div id="header_persona_contacto"></div>
        <h2 class="text-lg font-medium text-gray-900 flex justify-between">
            {{ __('Añadir Persona Contacto') }}
            <a href="#header_persona_contacto">
                <x-primary-nonsubmit-button type="button" id="add_section_button_2">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <!-- Hidden input field to count pc -->
        <input type="hidden" name="persona_count" id="persona_count" value="0">

        <div id="persona_contacto_wrapper"></div>

        <template id="persona_contacto_template">
            <details class="persona-contacto-section bg-white mt-6 border border-blue rounded-lg p-4 shadow-sm mb-6" open>
                <summary class="text-lg font-medium text-gray-900 cursor-pointer flex justify-between items-center">
                    <span class="persona-title-label">Persona de Contacto</span>
                    <button type="button" class="remove-persona text-red-500 hover:text-red-700 text-sm ml-4">❌</button>
                </summary>
                <hr class="mt-2">

                <div class="grid grid-cols-3 gap-6 mb-6" >
                    <!-- DNI -->
                    <div>
                        <x-input-label-light for="pc_dni" :value="__('DNI/NIE <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="pc_dni" name="pc_dni" value="" type="text" class="mt-1 block w-full" autocomplete="dni" />
                        <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                    </div>

                    <!-- Nombre -->
                    <div>
                        <x-input-label-light for="pc_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="pc_nombre" name="pc_nombre" value="" type="text" class="mt-1 block w-full" autocomplete="nombre"  />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <!-- Apellido -->
                    <div>
                        <x-input-label-light for="pc_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                        <x-text-input id="pc_apellido" name="pc_apellido" value=""  type="text" class="mt-1 block w-full" autocomplete="apellido"  />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <!-- Telefono -->
                    <div>
                        <x-input-label-light for="pc_telefono" :value="__('Teléfono')" />
                        <x-text-input id="pc_telefono" name="pc_telefono" value="" maxlength="9" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label-light for="pc_email" :value="__('Email')" />
                        <x-text-input id="pc_email" name="pc_email" value="" type="text" class="mt-1 block w-full" autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
            </details>
        </template>

        <!-- Bottom button and status bar -->
        <x-form-buttons :currentRoute="route('empresa-form-2')" />
    </form>
</section>
<script>
    document.getElementById('form').addEventListener('submit', function (e) {
    const sections = document.querySelectorAll('.persona-contacto-section');

        sections.forEach(section => {
            const dni = section.querySelector('[name="pc_dni"]').value.trim();
            const nombre = section.querySelector('[name="pc_nombre"]').value.trim();
            const apellido = section.querySelector('[name="pc_apellido"]').value.trim();

            if (!dni && !nombre && !apellido) {
                section.remove(); // Remove this empty responsable block
            }
        });
    });

    function updateCentroTitles() {
        const sections = document.querySelectorAll('.centro-trabajo-section');
        document.getElementById('centro_count').value = sections.length;

        sections.forEach((section, index) => {
            const num = index + 1;

            // Update title
            const titleLabel = section.querySelector('.centro-title-label');
            if (titleLabel) {
                titleLabel.textContent = `Centro de Trabajo #${num}`;
            }

            // Update input IDs and names for centro fields
            const centroFields = [
                'direccion', 'codigoPostal', 'comunidad', 
                'provincia', 'municipio'
            ];

            centroFields.forEach(field => {
                const input = section.querySelector(`[name="${field}"]`);
                if (input) {
                    input.id = `${field}_${num}`;
                    input.name = `${field}_${num}`;
                }
            });

            // Update labels
            const labels = section.querySelectorAll('label');
            labels.forEach(label => {
                const forAttr = label.getAttribute('for');
                if (forAttr && centroFields.some(field => forAttr.startsWith(field))) {
                    label.setAttribute('for', `${forAttr}_${num}`);
                }
            });
        });
    }

    document.getElementById('add_section_button_1').addEventListener('click', function () {
        const wrapper = document.getElementById('centro_trabajo_wrapper');
        const template = document.getElementById('centro_trabajo_template');
        const clone = template.content.cloneNode(true);
        wrapper.appendChild(clone);

        updateCentroTitles();
    });

    document.getElementById('centro_trabajo_wrapper').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-centro')) {
            const section = e.target.closest('.centro-trabajo-section');
            if (section) {
                section.remove();
                updateCentroTitles();
            }
        }
    });

    // Initial call
    document.addEventListener('DOMContentLoaded', updateCentroTitles);

    // Persona Contacto 
    function updatePersonaTitles() {
        const sections = document.querySelectorAll('.persona-contacto-section');
        document.getElementById('persona_count').value = sections.length;

        sections.forEach((section, index) => {
            const num = index + 1;

            // Update title
            const titleLabel = section.querySelector('.persona-title-label');
            if (titleLabel) {
                titleLabel.textContent = `Persona Contacto #${num}`;
            }

            // Update input IDs and names
            const inputs = [
                'pc_dni', 'pc_nombre', 'pc_apellido', 'pc_telefono', 'pc_email'
            ];

            inputs.forEach(field => {
                const input = section.querySelector(`[name^="${field}"]`);
                if (input) {
                    input.id = `${field}_${num}`;
                    input.name = `${field}_${num}`;
                }
            });

            // Update labels
            const labels = section.querySelectorAll('label');
            labels.forEach(label => {
                const forAttr = label.getAttribute('for');
                if (forAttr && forAttr.startsWith('pc_')) {
                    label.setAttribute('for', `${forAttr}_${num}`);
                }
            });
        });
    }

    document.getElementById('add_section_button_2').addEventListener('click', function () {
        const wrapper = document.getElementById('persona_contacto_wrapper');
        const template = document.getElementById('persona_contacto_template');
        const clone = template.content.cloneNode(true);
        wrapper.appendChild(clone);

        updatePersonaTitles();
    });

    document.getElementById('persona_contacto_wrapper').addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-persona')) {
            const section = e.target.closest('.persona-contacto-section');
            if (section) {
                section.remove();
                updatePersonaTitles();
            }
        }
    });

    // Initial numbering on page load
    document.addEventListener('DOMContentLoaded', updatePersonaTitles);
</script>