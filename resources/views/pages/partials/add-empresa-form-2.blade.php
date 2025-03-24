<section>
    <!-- <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Añadir Centro Trabajo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Aquí se introducen los datos del Centro Trabajo y el de la Persona Contacto.') }}
        </p>
    </header>  -->

    <form method="POST" id="form" action="{{ route('store-empresa') }}" class="mt-6 space-y-6">
        @csrf <!-- CSRF token for security -->

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Responsable Convenio') }}
            <a>
                <x-primary-nonsubmit-button id="add_section_button_1">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <div id="centro_trabajo" class="space-y-6" style="display:block">
            <!-- Dirección -->
            <div>
                <x-input-label for="direccion" :value="__('Dirección')" />
                <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
            </div>

            <!-- Código Postal -->
            <div>
                <x-input-label for="codigoPostal" :value="__('Código Postal')" />
                <x-text-input id="codigoPostal" name="codigoPostal" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
            </div>

            <!-- Ubicación -->
            <div>
                <x-input-label for="ubicacion" :value="__('Ubicación')" />
                <x-text-input id="ubicacion" name="ubicacion" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
            </div>

            <!-- Municipio -->
            <div>
                <x-input-label for="municipio" :value="__('Municipio')" />
                <x-text-input id="municipio" name="municipio" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
            </div>
        </div>

        <hr>

        <div id="header_persona_contacto"></div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Persona Contacto') }}
            <a href="#header_persona_contacto">
                <x-primary-nonsubmit-button id="add_section_button_2">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <div id="persona_contacto" class="space-y-6" style="display:block">
            <!-- DNI -->
            <div>
                <x-input-label for="pc_dni" :value="__('DNI <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="pc_dni" name="pc_dni" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>

            <!-- Nombre -->
            <div>
                <x-input-label for="pc_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="pc_nombre" name="pc_nombre" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <!-- Apellido -->
            <div>
                <x-input-label for="pc_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="pc_apellido" name="pc_apellido" type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>

            <!-- Telefono -->
            <div>
                <x-input-label for="pc_telefono" :value="__('Teléfono')" />
                <x-text-input id="pc_telefono" name="pc_telefono" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="pc_email" :value="__('Email')" />
                <x-text-input id="pc_email" name="pc_email" type="text" class="mt-1 block w-full" autocomplete="email" />
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
        document.getElementById('add_section_button_1').addEventListener('click', showCentroTrabajo);
        document.getElementById('add_section_button_2').addEventListener('click', showPersonaContacto);
        
        showCentroTrabajo(); // Set required to false on startup
        function showCentroTrabajo() {
            const centroTrabajo = document.getElementById('centro_trabajo');

            if (centroTrabajo.style.display !== 'block') {
                // Show Area
                centroTrabajo.style.display = 'block';
                document.getElementById('add_section_button_1').textContent = " - ";
            } else {
                // Hide Area
                centroTrabajo.style.display = 'none';
                document.getElementById('add_section_button_1').textContent = " + ";
            }
        }

        showPersonaContacto(); // Set required to false on startup
        function showPersonaContacto() {
            const personaContacto = document.getElementById('persona_contacto');
            const requiredFields = personaContacto.querySelectorAll('#pc_dni, #pc_nombre, #pc_apellido');

            if (personaContacto.style.display !== 'block') {
                // Show Area
                personaContacto.style.display = 'block';
                document.getElementById('add_section_button_2').textContent = " - ";
                requiredFields.forEach(function (field) {
                    field.required = true;
                    field.disabled = false;
                });
            } else {
                // Hide Area
                personaContacto.style.display = 'none';
                document.getElementById('add_section_button_2').textContent = " + ";
                requiredFields.forEach(function (field) {
                    field.required = false;
                    field.disabled = true;
                });
            }
        }
    });
</script>