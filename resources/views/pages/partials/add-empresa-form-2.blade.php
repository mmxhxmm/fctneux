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

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Centro Trabajo') }}
            <a>
                <x-primary-nonsubmit-button type="button" id="add_section_button_1">{{ __(' - ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <div id="centro_trabajo" class="space-y-6" style="display:block">
            <!-- Dirección -->
            <div>
                <x-input-label for="direccion" :value="__('Dirección')" />
                <x-text-input id="direccion" name="direccion" value="{{ old('direccion', session('centroTrabajo_draft')?->direccion) }}" type="text" class="mt-1 block w-full" autocomplete="direccion" />
                <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
            </div>

            <!-- Código Postal -->
            <div>
                <x-input-label for="codigoPostal" :value="__('Código Postal')" />
                <x-text-input id="codigoPostal" name="codigoPostal" value="{{ old('codigoPostal', session('centroTrabajo_draft')?->codigoPostal) }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
            </div>

            <!-- Ubicación -->
            <div>
                <x-input-label for="ubicacion" :value="__('Ubicación')" />
                <x-text-input id="ubicacion" name="ubicacion" value="{{ old('ubicacion', session('centroTrabajo_draft')?->ubicacion) }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
            </div>

            <!-- Municipio -->
            <div>
                <x-input-label for="municipio" :value="__('Municipio')" />
                <x-text-input id="municipio" name="municipio" value="{{ old('municipio', session('centroTrabajo_draft')?->municipio) }}" type="text" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('ubicacion')" class="mt-2" />
            </div>
        </div>

        <hr>

        <div id="header_persona_contacto"></div>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 flex justify-between">
            {{ __('Añadir Persona Contacto') }}
            <a href="#header_persona_contacto">
                <x-primary-nonsubmit-button type="button" id="add_section_button_2">{{ __(' + ') }}</x-primary-nonsubmit-button>
            </a>
        </h2>

        <div id="secondarySection" class="space-y-6" style="display:block">
            <!-- DNI -->
            <div>
                <x-input-label for="pc_dni" :value="__('DNI <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="pc_dni" name="pc_dni" value="{{ old('pc_dni', session('personaContacto_draft')?->dni) }}" type="text" class="mt-1 block w-full" autocomplete="dni" required />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>

            <!-- Nombre -->
            <div>
                <x-input-label for="pc_nombre" :value="__('Nombre <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="pc_nombre" name="pc_nombre" value="{{ old('pc_nombre', session('personaContacto_draft')?->nombre) }}" type="text" class="mt-1 block w-full" autocomplete="nombre" required />
                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
            </div>

            <!-- Apellido -->
            <div>
                <x-input-label for="pc_apellido" :value="__('Apellido <span class=\'text-red-500\'>*</span>')" />
                <x-text-input id="pc_apellido" name="pc_apellido" value="{{ old('pc_apellido', session('personaContacto_draft')?->apellido) }}"  type="text" class="mt-1 block w-full" autocomplete="apellido" required />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>

            <!-- Telefono -->
            <div>
                <x-input-label for="pc_telefono" :value="__('Teléfono')" />
                <x-text-input id="pc_telefono" name="pc_telefono" value="{{ old('pc_telefono', session('personaContacto_draft')?->telefono) }}" type="text" class="mt-1 block w-full" autocomplete="telefono" />
                <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="pc_email" :value="__('Email')" />
                <x-text-input id="pc_email" name="pc_email" value="{{ old('pc_email', session('personaContacto_draft')?->email) }}" type="text" class="mt-1 block w-full" autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Bottom button and status bar -->
        <x-form-buttons :currentRoute="route('empresa-form-2')" />
    </form>
</section>