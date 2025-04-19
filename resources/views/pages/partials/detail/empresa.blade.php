<section class="flex flex-col space-y-12">
    <div class="p-6 relative">
        <!-- Toggleable Edit Button -->
        <button 
            id="edit-btn-empresa"
            type="button" 
            class="edit-btn absolute px-2 rounded top-6 right-6 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-target="empresa"> Editar
        </button>
        
        <!-- Display Mode -->
        <div id="display-empresa" class="grid md:grid-cols-2 gap-8 text-gray-800 text-[15px] leading-relaxed">
            <div class="space-y-2">
                <p><span class="font-semibold">Nombre:</span> {{ $empresa->nombre }}</p>
                <p><span class="font-semibold">CIF:</span> {{ $empresa->cif }}</p>
                <p><span class="font-semibold">Colaboración:</span> {{ $empresa->colaboracionToString($empresa->colaboracion) }}</p>
                <p><span class="font-semibold">Gestiones:</span> {{ $empresa->gestionesToString($empresa->gestiones) }}</p>
                <p><span class="font-semibold">Modalidad:</span> {{ ucwords(strtolower($empresa->modalidad)) }}</p>
                <p><span class="font-semibold">Familia Personal:</span> {{ ucwords(strtolower($empresa->familiaPersonal)) }}</p>
                <p><span class="font-semibold">Oferta Laboral:</span> {{ ucwords(strtolower($empresa->ofertaLaboral)) }}</p>
            </div>
            <div class="space-y-2">
                <p><span class="font-semibold">Entidad:</span> {{ $empresa->entidad }}</p>
                <p><span class="font-semibold">Comunidad:</span> {{ $empresa->comunidadToString($empresa->comunidad) }}</p>
                <p><span class="font-semibold">Provincia:</span> {{ $empresa->provinciaToString($empresa->provincia) }}</p>
                <p><span class="font-semibold">Municipio:</span> {{ ucwords(mb_strtolower($empresa->municipio)) }}</p>
                <p><span class="font-semibold">Dirección:</span> {{ $empresa->direccion }}</p>
                <p><span class="font-semibold">Código Postal:</span> {{ $empresa->codigoPostal }}</p>
                <p><span class="font-semibold">Observaciones:</span> {{ $empresa->observaciones }}</p>
            </div>
        </div>
        
        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-empresa" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-4">Editar Empresa</h3>
            <form id="form" method="POST" action="{{ route('empresa.update', $empresa->id) }}" class="grid md:grid-cols-2 gap-6">
                @csrf
                @method('PUT')
                
                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="nombre" value="Nombre" />
                        <x-text-input-light id="nombre" name="nombre" value="{{ $empresa->nombre }}" />
                    </div>
                
                    <div>
                        <x-input-label for="cif" value="CIF" />
                        <x-text-input-light id="cif" name="cif" value="{{ $empresa->cif }}" />
                    </div>

                    <!-- Colaboración -->
                    <div>
                        <x-input-label for="colaboracion" :value="__('Colaboración')" />
                        <x-select-input-light name="colaboracion" id="colaboracion" class="block w-full">
                            <option value="prospeccion"
                            {{ $empresa->colaboracion == 'prospeccion' ? 'selected' : '' }}>
                                Prospección</option>
                            <option value="colaboracion" {{ $empresa->colaboracion == 'colaboracion' ? 'selected' : '' }}>
                                Colaboración</option>
                            <option value="inactiva" {{ $empresa->colaboracion == 'inactiva' ? 'selected' : '' }}>
                                Inactiva</option>
                        </x-select-input-light>
                    </div>

                    <!-- Gestiones -->
                    <div>
                        <x-input-label for="gestiones" :value="__('Gestiones')" />

                        <div id="prospeccion-options" style="display: none;">
                            <x-select-input-light name="gestiones_prospeccion" id="gestiones">
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
                            </x-select-input-light>
                        </div>

                        <div id="colaboracion-options" style="display: none;">
                            <x-select-input-light name="gestiones_colaboracion" id="gestiones">
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
                            </x-select-input-light>
                        </div>

                        <div id="inactiva-options" style="display: none;">
                            <x-select-input-light name="gestiones_inactiva" id="gestiones">
                                <x-session-option 
                                    value="null" 
                                    :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                                    label="--"
                                />
                            </x-select-input>
                        </div>
                    </div>

                    <div>
                        <x-input-label-light for="modalidad" :value="__('Modalidad')" />
                        <x-select-input-light name="modalidad" id="modalidad">
                            <x-session-option 
                                value="presencial" 
                                :selectedValue="$empresa->modalidad" 
                                label="Presencial"
                            />
                            <x-session-option 
                                value="remoto" 
                                :selectedValue="$empresa->modalidad" 
                                label="Remoto"
                            />
                            <x-session-option 
                                value="semipresencial" 
                                :selectedValue="$empresa->modalidad" 
                                label="Semipresencial"
                            />
                        </x-select-input-light>
                    </div>

                    <div>
                        <x-input-label for="familiaPersonal" value="Familia Personal" />
                        <x-select-input-light name="familiaPersonal" id="familiaPersonal" class="mt-1 block w-full">
                            <x-session-option 
                                value="sanidad" 
                                :selectedValue="$empresa->familiaPersonal" 
                                label="Sanidad"
                            />
                            <x-session-option 
                                value="informatica" 
                                :selectedValue="$empresa->familiaPersonal" 
                                label="Informática"
                            />
                            <x-session-option 
                                value="hosteleria" 
                                :selectedValue="$empresa->familiaPersonal"  
                                label="Hostelería"
                            />
                            <x-session-option 
                                value="marketing" 
                                :selectedValue="$empresa->familiaPersonal" 
                                label="Marketing"
                            />
                        </x-select-input-light>
                    </div>

                    <div>
                        <x-input-label-light for="ofertaLaboral" :value="__('Oferta Laboral')" />
                        <x-select-input-light name="ofertaLaboral" id="ofertaLaboral">
                            <x-session-option 
                                value="" 
                                :selectedValue="$empresa->ofertaLaboral" 
                                label="--"
                            />
                            <x-session-option 
                                value="si" 
                                :selectedValue="$empresa->ofertaLaboral" 
                                label="Si"
                            />
                            <x-session-option 
                                value="no" 
                                :selectedValue="$empresa->ofertaLaboral" 
                                label="No"
                            />
                        </x-select-input-light>
                    </div>
                </div>

                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="entidad" value="Entidad" />
                        <x-text-input-light id="entidad" name="entidad" value="{{ $empresa->entidad }}" />
                    </div>

                    <!-- Comunidad Autónoma -->
                    <div>
                        <x-input-label for="comunidad" value="Comunidad" />
                        <x-select-input-light name="comunidad" id="comunidad"
                            class="comunidad block border border-gray-300 w-full mt-1 rounded text-gray-900"
                            data-initial-value="{{ $empresa->comunidad }}">
                            <option value="">Selecciona una comunidad</option>
                        </x-select-input-light>
                    </div>

                    <!-- Provincia -->
                    <div>
                        <x-input-label-light for="provincia" :value="__('Provincia')" />
                        <x-select-input-light name="provincia" id="provincia"
                            class="provincia block w-full mt-1 border border-gray-300 rounded text-gray-900"
                            data-initial-value="{{ $empresa->provincia }}">
                            <option value="">Selecciona una provincia</option>
                        </x-select-input-light>
                    </div>

                    <!-- Municipio -->
                    <div>
                        <x-input-label-light for="municipio" :value="__('Municipio')" />
                        <x-select-input-light name="municipio" id="municipio"
                        class="municipio block w-full mt-1 border border-gray-300 rounded text-gray-900"
                        data-initial-value="{{ $empresa->municipio }}">
                            <option value="">Selecciona un municipio</option>
                        </x-select-input-light>
                    </div>

                    <div>
                        <x-input-label for="direccion" value="Dirección" />
                        <x-text-input-light id="direccion" name="direccion" value="{{ $empresa->direccion }}" />
                    </div>

                    <div>
                        <x-input-label for="codigoPostal" value="Código Postal" />
                        <x-text-input-light id="codigoPostal" name="codigoPostal" value="{{ $empresa->codigoPostal }}" />
                    </div>

                    <div>
                        <x-input-label for="observaciones" value="Observaciones" />
                        <textarea id="observaciones" name="observaciones" rows="3" class="block w-full border-gray-700 bg-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $empresa->observaciones }}</textarea>
                    </div>
                </div>
                
                <div class="md:col-span-2 flex justify-end gap-4">
                    <button type="button" class="cancel-edit-btn" data-target="empresa">
                        Cancelar
                    </button>
                    <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                        Guardar Cambios
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

        // Colaboracion change
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