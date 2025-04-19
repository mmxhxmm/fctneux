<section class="flex flex-col space-y-12">
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
            <h3 class="text-xl font-semibold text-blue mb-4">Centro de Trabajo - {{ $centro->municipio }}</h3>
            <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                <p><strong>Código Postal:</strong> {{ $centro->codigoPostal }}</p>
                <p><strong>Comunidad:</strong> {{ $centro->comunidadToString($centro->comunidad) }}</p>
                <p><strong>Provincia:</strong> {{ $centro->provinciaToString($centro->provincia) }}</p>
                <p><strong>Municipio:</strong> {{ ucwords(mb_strtolower($centro->municipio)) }}</p>
                <p><strong>Dirección:</strong> {{ $centro->direccion }}</p>
            </div>
        </div>
        
        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-cen-trab-{{ $index }}" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-4">Editar Centro de Trabajo</h3>
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
                        class="comunidad block border border-gray-300 w-full mt-1 rounded text-gray-900"
                        data-initial-value="{{ $centro->comunidad }}">
                        <option value="">Selecciona una comunidad</option>
                    </x-select-input-light>
                </div>

                <!-- Provincia -->
                <div>
                    <x-input-label-light for="provincia-{{ $index }}" :value="__('Provincia')" />
                    <x-select-input-light name="provincia" id="provincia-{{ $index }}"
                        class="provincia block w-full mt-1 border border-gray-300 rounded text-gray-900"
                        data-initial-value="{{ $centro->provincia }}">
                        <option value="">Selecciona una provincia</option>
                    </x-select-input-light>
                </div>

                <!-- Municipio -->
                <div>
                    <x-input-label-light for="municipio-{{ $index }}" :value="__('Municipio')" />
                    <x-select-input-light name="municipio" id="municipio-{{ $index }}"
                    class="municipio block w-full mt-1 border border-gray-300 rounded text-gray-900"
                    data-initial-value="{{ $centro->municipio }}">
                        <option value="">Selecciona un municipio</option>
                    </x-select-input-light>
                </div>
                
                <div class="md:col-span-2">
                    <x-input-label for="direccion-{{ $index }}" value="Dirección" />
                    <x-text-input-light id="direccion-{{ $index }}" name="direccion" value="{{ $centro->direccion }}" />
                </div>
                
                <div class="md:col-span-3 flex justify-end gap-4">
                    <button type="button" class="cancel-edit-btn" data-target="cen-trab-{{ $index }}">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>

        <div id="display-cen-trab-pc-{{ $index }}">
            @foreach ($centro->personaContacto as $persContacto)
                <details class="mt-6 bg-white border border-blue rounded-lg p-4">
                    <summary class="cursor-pointer text-blue font-semibold">Persona de Contacto - {{ $persContacto->nombre }} {{ $persContacto->apellido }}</summary>
                    <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700">
                        <p><strong>DNI:</strong> {{ $persContacto->dni }}</p>
                        <p><strong>Nombre:</strong> {{ $persContacto->nombre }} {{ $persContacto->apellido }}</p>
                        <p><strong>Teléfono:</strong> {{ $persContacto->telefono }}</p>
                        <p><strong>Email:</strong> {{ $persContacto->email }}</p>
                    </div>
                </details>
            @endforeach
        </div>

        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-cen-trab-pc-{{ $index }}" class="hidden">
            <form method="POST" action="{{ route('centroTrabajo.update', $centro->id) }}" class="grid md:grid-cols-3 gap-6">
                <!-- Municipio -->
                <div>
                    <x-input-label-light for="municipio-{{ $index }}" :value="__('Municipio')" />
                    <x-select-input-light name="municipio" id="municipio-{{ $index }}"
                    class="municipio block w-full mt-1 border border-gray-300 rounded text-gray-900"
                    data-initial-value="{{ $centro->municipio }}">
                        <option value="">Selecciona un municipio</option>
                    </x-select-input-light>
                </div>
                
                <div class="md:col-span-2">
                    <x-input-label for="direccion-{{ $index }}" value="Dirección" />
                    <x-text-input-light id="direccion-{{ $index }}" name="direccion" value="{{ $centro->direccion }}" />
                </div>
                
                <div class="md:col-span-3 flex justify-end gap-4">
                    <button type="button" class="cancel-edit-btn" data-target="cen-trab-{{ $index }}">
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

        // GEO API
        const key = "bf9bf54cbf3e6f52ea4f61d205d533c745dc29471259d43d982c83081fc3ce06";
        const comunidadSelect = document.querySelector(".comunidad");
        const provinciaSelect = document.querySelector(".provincia");
        const municipioSelect = document.querySelector(".municipio");

        async function cargarComunidades() {
            const res = await fetch(`https://apiv1.geoapi.es/comunidades?type=JSON&key=${key}`);
            const data = await res.json();

            const initialComunidad = comunidadSelect.dataset.initialValue;

            comunidadSelect.innerHTML = `<option value="">Selecciona una comunidad</option>`;
            data.data.forEach(c => {
                const option = document.createElement("option");
                option.value = c.CCOM;
                option.text = c.COM;
                if (initialComunidad && c.CCOM === initialComunidad) {
                    option.selected = true;
                }
                comunidadSelect.appendChild(option);
            });

            if (initialComunidad) {
                await cargarProvincias(initialComunidad);
            }
        }

        async function cargarProvincias(ccom) {
            const res = await fetch(`https://apiv1.geoapi.es/provincias?CCOM=${ccom}&type=JSON&key=${key}`);
            const data = await res.json();

            const initialProvincia = provinciaSelect.dataset.initialValue;

            municipioSelect.innerHTML = `<option value="">Selecciona un municipio</option>`;
            data.data.forEach(p => {
                const option = document.createElement("option");
                option.value = p.CPRO;
                option.text = p.PRO;
                if (initialProvincia && p.CPRO === initialProvincia) {
                    option.selected = true;
                }
                provinciaSelect.appendChild(option);
            });

            if (initialProvincia) {
                await cargarMunicipios(initialProvincia);
            }
        }


        async function cargarMunicipios(cpro) {
            const res = await fetch(`https://apiv1.geoapi.es/municipios?CPRO=${cpro}&type=JSON&key=${key}`);
            const data = await res.json();

            const initialMunicipio = municipioSelect.dataset.initialValue;

            municipioSelect.innerHTML = `<option value="">Selecciona un municipio</option>`;
            data.data.forEach(m => {
                const option = document.createElement("option");
                option.value = m.DMUN50;
                option.text = m.DMUN50;
                if (initialMunicipio && m.DMUN50 === initialMunicipio) {
                    option.selected = true;
                }
                municipioSelect.appendChild(option);
            });
        }

        // Event Listeners
        comunidadSelect.addEventListener("change", e => {
            const ccom = e.target.value;
            if (ccom) cargarProvincias(ccom);
        });

        provinciaSelect.addEventListener("change", e => {
            const cpro = e.target.value;
            if (cpro) cargarMunicipios(cpro);
        });

        // Initial load
        cargarComunidades();
    });
</script>