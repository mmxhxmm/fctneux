<section class="flex flex-col space-y-12">
    <?php
        $index2Sum = 0
    ?>

    @foreach ($empresa->centrosTrabajo as $index => $centro)
    <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
        <!-- Toggle Button -->
        <button 
            id="edit-btn-cen-trab-{{ $index }}"
            type="button" 
            class="edit-btn absolute px-2 rounded top-6 right-6 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-target="cen-trab-{{ $index }}"> Editar
        </button>
        
        <!-- Display Mode -->
        <div id="display-cen-trab-{{ $index }}">
            <h3 class="text-xl font-semibold text-blue mb-8">Centro de Trabajo - {{ $centro->municipio }}</h3>
            <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                <p><strong>Código Postal:</strong> {{ $centro->codigoPostal }}</p>
                <p><strong>Comunidad:</strong> {{ ucwords(mb_strtolower($centro->comunidadToString($centro->comunidad))) }}</p>
                <p><strong>Provincia:</strong> {{ ucwords(mb_strtolower($centro->provinciaToString($centro->provincia))) }}</p>
                <p><strong>Municipio:</strong> {{ ucwords(mb_strtolower($centro->municipio)) }}</p>
                <p><strong>Dirección:</strong> {{ $centro->direccion }}</p>
            </div>

            <!-- Separador -->
            <div class="mt-10"></div>

            <!-- Display Persona Contacto -->
            @foreach ($centro->personaContacto as $persContacto)
                <?php
                    $index2Sum++
                ?>
                <div id="display-pc-{{ $index2Sum }}">
                    <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                        <summary class="cursor-pointer text-blue font-semibold">Persona de Contacto - {{ $persContacto->nombre }} {{ $persContacto->apellido }}</summary>
                        <!-- Edit Button -->
                        <div class="w-full flex justify-end gap-2">
                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'coordinador')
                            <button type="button" onclick="confirmDeletePC({{ $persContacto->id }})"
                                class="mt-[-25px] bg-red-500 text-white px-2 py-1 rounded">
                                Eliminar
                            </button>
                            @endif

                            <button 
                                id="edit-btn-pc-{{ $index2Sum }}"
                                type="button" 
                                class="edit-btn mt-[-25px] px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
                                data-target="pc-{{ $index2Sum }}"> Editar
                            </button>
                        </div>

                        <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                            <p><strong>DNI:</strong> {{ $persContacto->dni }}</p>
                            <p><strong>Nombre:</strong> {{ $persContacto->nombre }} {{ $persContacto->apellido }}</p>
                            <p><strong>Teléfono:</strong> {{ $persContacto->telefono }}</p>
                            <p><strong>Email:</strong> {{ $persContacto->email }}</p>
                        </div>
                    </details>

                    <form id="delete-form-pc-{{ $persContacto->id }}" method="POST" action="{{ route('personaContacto.delete', $persContacto->id) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <script>
                        function confirmDeletePC(id) {
                            if (confirm('¿Estás seguro que quieres eliminar esta persona de contacto?')) {
                                document.getElementById('delete-form-pc-' + id).submit();
                            }
                        }
                    </script>
                </div>

                <div id="edit-pc-{{ $index2Sum }}" class="hidden mt-6 bg-white border border-blue rounded-lg p-4">
                    <p class="text-blue font-semibold mb-6">Editar Persona de Contacto - {{ $persContacto->nombre }} {{ $persContacto->apellido }}</p>
                    <form method="POST" action="{{ route('personaContacto.update', $persContacto->id) }}" class="grid md:grid-cols-3 gap-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <x-input-label for="dni-{{ $index2Sum }}" value="DNI <span class='text-red-500'>*</span>" />
                            <x-text-input-light id="dni-{{ $index2Sum }}" name="dni" value="{{ $persContacto->dni }}" />
                            <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="nombre-{{ $index2Sum }}" value="Nombre <span class='text-red-500'>*</span>" />
                            <x-text-input-light id="nombre-{{ $index2Sum }}" name="nombre" value="{{ $persContacto->nombre }}" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="apellido-{{ $index2Sum }}" value="Apellido <span class='text-red-500'>*</span>" />
                            <x-text-input-light id="apellido-{{ $index2Sum }}" name="apellido" value="{{ $persContacto->apellido }}" />
                            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="telefono-{{ $index2Sum }}" value="Teléfono" />
                            <x-text-input-light id="telefono-{{ $index2Sum }}" name="telefono" value="{{ $persContacto->telefono }}" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>
                        
                        <div>
                            <x-input-label for="email-{{ $index2Sum }}" value="Email" />
                            <x-text-input-light id="email-{{ $index2Sum }}" name="email" value="{{ $persContacto->email }}" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        
                        <div class="md:col-span-3 flex justify-end gap-6 mt-4">
                            <button type="button" class="cancel-edit-btn" data-target="pc-{{ $index2Sum }}">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            @endforeach

            <!-- Add Persona Contacto -->
            <div id="add-display-pc-{{ $index }}">
                <div class="mt-6 bg-white border border-blue rounded-lg py-2 pr-3 pl-7 flex justify-between items-center">
                    <p class="text-blue font-semibold">Persona de Contacto</p>
                    <button 
                        type="button" 
                        data-target="pc-{{ $index }}"
                        class="add-btn-pc px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80">
                        Añadir +
                    </button>
                </div>
            </div>

            <!-- Form Add Persona Contacto -->
            <div id="add-form-pc-{{ $index }}" class="hidden mt-6 bg-white border border-blue rounded-lg px-7 py-4 relative">
                <h3 class="text-md font-semibold text-blue mb-8">Añadir Persona de Contacto</h3>
                <form method="POST" action="{{ route('personaContacto.add', $centro->id) }}" class="grid md:grid-cols-3 gap-6 mt-4">
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
                        <button type="button" class="cancel-add-btn-pc" data-target="pc-{{ $index }}">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                            Añadir
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-cen-trab-{{ $index }}" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-8">Editar Centro de Trabajo - {{ $centro->municipio }}</h3>
            <form method="POST" action="{{ route('centroTrabajo.update', $centro->id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="codigoPostal-{{ $index }}" value="Código Postal" />
                    <x-text-input-light id="codigoPostal-{{ $index }}" name="codigoPostal" value="{{ $centro->codigoPostal }}" />
                </div>

                <!-- Comunidad Autónoma -->
                <div>
                    <x-input-label for="comunidad-{{ $index }}" value="Comunidad" />
                    <x-select-input-light name="comunidad" id="comunidad-{{ $index }}"
                        class="comunidad-ct block border border-gray-300 w-full mt-1 rounded text-gray-900"
                        data-initial-value="{{ $centro->comunidad }}">
                        <option value="">Selecciona una comunidad</option>
                    </x-select-input-light>
                </div>

                <!-- Provincia -->
                <div>
                    <x-input-label-light for="provincia-{{ $index }}" :value="__('Provincia')" />
                    <x-select-input-light name="provincia" id="provincia-{{ $index }}"
                        class="provincia-ct block w-full mt-1 border border-gray-300 rounded text-gray-900"
                        data-initial-value="{{ $centro->provincia }}">
                        <option value="">Selecciona una provincia</option>
                    </x-select-input-light>
                </div>

                <!-- Municipio -->
                <div>
                    <x-input-label-light for="municipio-{{ $index }}" :value="__('Municipio')" />
                    <x-select-input-light name="municipio" id="municipio-{{ $index }}"
                    class="municipio-ct block w-full mt-1 border border-gray-300 rounded text-gray-900"
                    data-initial-value="{{ $centro->municipio }}">
                        <option value="">Selecciona un municipio</option>
                    </x-select-input-light>
                </div>
                
                <div class="md:col-span-2">
                    <x-input-label for="direccion-{{ $index }}" value="Dirección" />
                    <x-text-input-light id="direccion-{{ $index }}" name="direccion" value="{{ $centro->direccion }}" />
                </div>
                
                <div class="md:col-span-3 flex justify-between gap-4 mt-4">
                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'coordinador')
                    <button type="button" onclick="confirmDeleteCT({{ $centro->id }})" class="bg-red-500 text-white px-4 py-2 rounded">
                        Eliminar
                    </button>
                    @endif
                    <div></div>
                
                    <div class="flex gap-6">
                        <button type="button" class="cancel-edit-btn" data-target="cen-trab-{{ $index }}">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>

            <form id="delete-form-cen-trab-{{ $centro->id }}" method="POST" action="{{ route('centroTrabajo.delete', $centro->id) }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <script>
                function confirmDeleteCT(id) {
                    if (confirm('¿Estás seguro que quieres eliminar este centro de trabajo?')) {
                        document.getElementById('delete-form-cen-trab-' + id).submit();
                    }
                }
            </script>
        </div>
    </div>
    @endforeach

    <div>
        <!-- Display Add -->
        <div id="add-display-ct" class="bg-white_dull flex justify-between items-center py-3 px-6 rounded-xl border-l-4 border-blue shadow-sm relative">
            <h3 class="text-xl font-semibold text-blue">Centro de Trabajo</h3>
            <button 
                id="add-btn-ct"
                type="button" 
                class="px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80">
                Añadir +
            </button>
        </div>

        <!-- Form Add -->
        <div id="add-form-ct" class="hidden bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
            <h3 class="text-xl font-semibold text-blue mb-8">Añadir Centro de Trabajo</h3>
            <form method="POST" action="{{ route('centroTrabajo.add', $id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="codigoPostal" value="Código Postal" />
                    <x-text-input-light id="codigoPostal" name="codigoPostal" />
                    <x-input-error :messages="$errors->get('codigoPostal')" class="mt-2" />
                </div>

                <!-- Comunidad Autónoma -->
                <div>
                    <x-input-label for="comunidad" value="Comunidad" />
                    <x-select-input-light name="comunidad" id="comunidad"
                        class="comunidad-ct-add block border border-gray-300 w-full mt-1 rounded text-gray-900">
                        <option value="">Selecciona una comunidad</option>
                    </x-select-input-light>
                </div>

                <!-- Provincia -->
                <div>
                    <x-input-label-light for="provincia" :value="__('Provincia')" />
                    <x-select-input-light name="provincia" id="provincia"
                        class="provincia-ct-add block w-full mt-1 border border-gray-300 rounded text-gray-900">
                        <option value="">Selecciona una provincia</option>
                    </x-select-input-light>
                </div>

                <!-- Municipio -->
                <div>
                    <x-input-label-light for="municipio" :value="__('Municipio')" />
                    <x-select-input-light name="municipio" id="municipio"
                    class="municipio-ct-add block w-full mt-1 border border-gray-300 rounded text-gray-900">
                        <option value="">Selecciona un municipio</option>
                    </x-select-input-light>
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="direccion" value="Dirección" />
                    <x-text-input-light id="direccion" name="direccion" />
                </div>
                
                <div class="md:col-span-3 flex justify-end gap-6">
                    <button type="button" id="cancel-add-btn-ct">
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

        // // Edit buttons
        // document.querySelectorAll('.edit-btn').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const target = this.getAttribute('data-target');

        //         document.getElementById(`display-${target}`).classList.add('hidden');
        //         document.getElementById(`edit-${target}`).classList.remove('hidden');
        //         document.getElementById(`edit-btn-${target}`).classList.add('hidden');
        //     });
        // });
        
        // // Cancel buttons
        // document.querySelectorAll('.cancel-edit-btn').forEach(button => {
        //     button.addEventListener('click', function() {
        //         const target = this.getAttribute('data-target');

        //         document.getElementById(`edit-${target}`).classList.add('hidden');
        //         document.getElementById(`display-${target}`).classList.remove('hidden');
        //         document.getElementById(`edit-btn-${target}`).classList.remove('hidden');
        //     });
        // });

        // Add button
        document.getElementById('add-btn-ct').addEventListener('click', function() {
            document.getElementById('add-display-ct').classList.add('hidden');
            document.getElementById('add-form-ct').classList.remove('hidden');
        });
        // Cancel Add Button 
        document.getElementById('cancel-add-btn-ct').addEventListener('click', function() {
            document.getElementById('add-display-ct').classList.remove('hidden');
            document.getElementById('add-form-ct').classList.add('hidden');
        });
        
        // Add button PC
        document.querySelectorAll('.add-btn-pc').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`add-display-${target}`).classList.add('hidden');
                document.getElementById(`add-form-${target}`).classList.remove('hidden');
            });
        });
        // Cancel Add Button PC
        document.querySelectorAll('.cancel-add-btn-pc').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');

                document.getElementById(`add-display-${target}`).classList.remove('hidden');
                document.getElementById(`add-form-${target}`).classList.add('hidden');
            });
        });

        
        // GEO API
        const key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
        const comunidadSelectCT = document.querySelector(".comunidad-ct");
        const provinciaSelectCT = document.querySelector(".provincia-ct");
        const municipioSelectCT = document.querySelector(".municipio-ct");

        const comunidadSelectCTAdd = document.querySelector(".comunidad-ct-add");
        const provinciaSelectCTAdd = document.querySelector(".provincia-ct-add");
        const municipioSelectCTAdd = document.querySelector(".municipio-ct-add");

        async function cargarComunidades() {
            const res = await fetch(`https://apiv1.geoapi.es/comunidades?type=JSON&key=${key}`);
            const data = await res.json();

            const initialComunidad = comunidadSelectCT.dataset.initialValue;

            comunidadSelectCT.innerHTML = `<option value="">Selecciona una comunidad</option>`;
            data.data.forEach(c => {
                const option = document.createElement("option");
                option.value = c.CCOM;
                option.text = c.COM;
                if (initialComunidad && c.CCOM === initialComunidad) {
                    option.selected = true;
                }
                comunidadSelectCT.appendChild(option);
            });

            if (initialComunidad) {
                await cargarProvincias(initialComunidad);
            }
        }

        async function cargarComunidadesAdd() {
            const res = await fetch(`https://apiv1.geoapi.es/comunidades?type=JSON&key=${key}`);
            const data = await res.json();

            const initialComunidadAdd = comunidadSelectCTAdd.dataset.initialValue;

            comunidadSelectCTAdd.innerHTML = `<option value="">Selecciona una comunidad</option>`;
            data.data.forEach(c => {
                const option = document.createElement("option");
                option.value = c.CCOM;
                option.text = c.COM;
                if (initialComunidadAdd && c.CCOM === initialComunidadAdd) {
                    option.selected = true;
                }
                comunidadSelectCTAdd.appendChild(option);
            });

            if (initialComunidadAdd) {
                await cargarProvinciasAdd(initialComunidadAdd);
            }
        }

        async function cargarProvincias(ccom) {
            const res = await fetch(`https://apiv1.geoapi.es/provincias?CCOM=${ccom}&type=JSON&key=${key}`);
            const data = await res.json();

            const initialProvincia = provinciaSelectCT.dataset.initialValue;

            municipioSelectCT.innerHTML = `<option value="">Selecciona un municipio</option>`;
            data.data.forEach(p => {
                const option = document.createElement("option");
                option.value = p.CPRO;
                option.text = p.PRO;
                if (initialProvincia && p.CPRO === initialProvincia) {
                    option.selected = true;
                }
                provinciaSelectCT.appendChild(option);
            });

            if (initialProvincia) {
                await cargarMunicipios(initialProvincia);
            }
        }

        async function cargarProvinciasAdd(ccom) {
            const res = await fetch(`https://apiv1.geoapi.es/provincias?CCOM=${ccom}&type=JSON&key=${key}`);
            const data = await res.json();

            const initialProvinciaAdd = provinciaSelectCTAdd.dataset.initialValue;

            municipioSelectCTAdd.innerHTML = `<option value="">Selecciona un municipio</option>`;
            data.data.forEach(p => {
                const option = document.createElement("option");
                option.value = p.CPRO;
                option.text = p.PRO;
                if (initialProvinciaAdd && p.CPRO === initialProvinciaAdd) {
                    option.selected = true;
                }
                provinciaSelectCTAdd.appendChild(option);
            });

            if (initialProvinciaAdd) {
                await cargarMunicipiosAdd(initialProvinciaAdd);
            }
        }


        async function cargarMunicipios(cpro) {
            const res = await fetch(`https://apiv1.geoapi.es/municipios?CPRO=${cpro}&type=JSON&key=${key}`);
            const data = await res.json();

            const initialMunicipio = municipioSelectCT.dataset.initialValue;

            municipioSelectCT.innerHTML = `<option value="">Selecciona un municipio</option>`;
            data.data.forEach(m => {
                const option = document.createElement("option");
                option.value = m.DMUN50;
                option.text = m.DMUN50;
                if (initialMunicipio && m.DMUN50 === initialMunicipio) {
                    option.selected = true;
                }
                municipioSelectCT.appendChild(option);
            });
        }

        async function cargarMunicipiosAdd(cpro) {
            const res = await fetch(`https://apiv1.geoapi.es/municipios?CPRO=${cpro}&type=JSON&key=${key}`);
            const data = await res.json();

            const initialMunicipioAdd = municipioSelectCTAdd.dataset.initialValue;

            municipioSelectCTAdd.innerHTML = `<option value="">Selecciona un municipio</option>`;
            data.data.forEach(m => {
                const option = document.createElement("option");
                option.value = m.DMUN50;
                option.text = m.DMUN50;
                if (initialMunicipioAdd && m.DMUN50 === initialMunicipioAdd) {
                    option.selected = true;
                }
                municipioSelectCTAdd.appendChild(option);
            });
        }

        // Event Listeners
        comunidadSelectCT.addEventListener("change", e => {
            const ccom = e.target.value;
            if (ccom) cargarProvincias(ccom);
        });

        provinciaSelectCT.addEventListener("change", e => {
            const cpro = e.target.value;
            if (cpro) cargarMunicipios(cpro);
        });

        comunidadSelectCTAdd.addEventListener("change", e => {
            const ccom = e.target.value;
            if (ccom) cargarProvinciasAdd(ccom);
        });

        provinciaSelectCTAdd.addEventListener("change", e => {
            const cpro = e.target.value;
            if (cpro) cargarMunicipiosAdd(cpro);
        });

        // Initial load
        cargarComunidades();
        cargarComunidadesAdd();
    });
</script>