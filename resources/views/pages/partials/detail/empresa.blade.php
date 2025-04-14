<section class="flex flex-col space-y-12">
    @foreach ($empresa->responsablesConvenio as $index => $resConv)
    <div class="p-6 relative">
        <!-- Toggleable Edit Button -->
        <button 
            id="edit-btn-empresa-{{ $index }}"
            type="button" 
            class="edit-btn absolute px-2 rounded top-4 right-4 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-target="empresa-{{ $index }}"> Editar
        </button>
        
        <!-- Display Mode -->
        <div id="display-empresa-{{ $index }}" class="grid md:grid-cols-2 gap-8 text-gray-800 text-[15px] leading-relaxed">
            <div class="space-y-2">
                <p><span class="font-semibold">Nombre:</span> {{ $empresa->nombre }}</p>
                <p><span class="font-semibold">CIF:</span> {{ $empresa->cif }}</p>
                <p><span class="font-semibold">Colaboración:</span> {{ $empresa->colaboracion }}</p>
                <p><span class="font-semibold">Gestiones:</span> {{ $empresa->gestiones }}</p>
                <p><span class="font-semibold">Modalidad:</span> {{ $empresa->modalidad }}</p>
                <p><span class="font-semibold">Familia Personal:</span> {{ $empresa->familiaPersonal }}</p>
                <p><span class="font-semibold">Oferta Laboral:</span> {{ $empresa->ofertaLaboral }}</p>
            </div>
            <div class="space-y-2">
                <p><span class="font-semibold">Entidad:</span> {{ $empresa->entidad }}</p>
                <p><span class="font-semibold">Comunidad:</span> {{ getComunidadAttribute($empresa->comunidad) }}</p>
                <p><span class="font-semibold">Provincia:</span> {{ getProvinciaAttribute($empresa->provincia) }}</p>
                <p><span class="font-semibold">Municipio:</span> {{ getMunicipioAttribute($empresa->municipio) }}</p>
                <p><span class="font-semibold">Dirección:</span> {{ $empresa->direccion }}</p>
                <p><span class="font-semibold">Código Postal:</span> {{ $empresa->codigoPostal }}</p>
                <p><span class="font-semibold">Observaciones:</span> {{ $empresa->observaciones }}</p>
            </div>
        </div>
        
        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-empresa-{{ $index }}" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-4">Editar Empresa</h3>
            <form id="form" method="POST" action="{{ route('empresa.update', $empresa->id) }}" class="grid md:grid-cols-2 gap-6">
                @csrf
                @method('PUT')
                
                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="nombre-{{ $index }}" value="Nombre" />
                        <x-text-input-light id="nombre-{{ $index }}" name="nombre" value="{{ $empresa->nombre }}" />
                    </div>
                
                    <div>
                        <x-input-label for="cif-{{ $index }}" value="CIF" />
                        <x-text-input-light id="cif-{{ $index }}" name="cif" value="{{ $empresa->cif }}" />
                    </div>

                    <!-- <div>
                        <x-input-label for="colaboracion-{{ $index }}" value="Colaboracion" />
                        <x-text-input-light id="colaboracion-{{ $index }}" name="colaboracion" value="{{ $empresa->colaboracion }}" />
                    </div>

                    <div>
                        <x-input-label for="gestiones-{{ $index }}" value="Gestiones" />
                        <x-text-input-light id="gestiones-{{ $index }}" name="gestiones" value="{{ $empresa->gestiones }}" />
                    </div> -->


                    <!-- Colaboración -->
                    <div>
                        <x-input-label for="colaboracion" :value="__('Colaboración')" />
                        <x-select-input-light name="colaboracion" id="colaboracion" class="mt-1 block w-full">
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
                            <x-select-input-light name="gestiones_prospeccion" id="gestiones" class="mt-1 block w-full">
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
                            <x-select-input-light name="gestiones_colaboracion" id="gestiones" class="mt-1 block w-full">
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
                            <x-select-input-light name="gestiones_inactiva" id="gestiones" class="mt-1 block w-full">
                                <x-session-option 
                                    value="null" 
                                    :selectedValue="old('gestiones', session('empresa_draft')?->gestiones)" 
                                    label="--"
                                />
                            </x-select-input>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="modalidad-{{ $index }}" value="Modalidad" />
                        <x-text-input-light id="modalidad-{{ $index }}" name="modalidad" value="{{ $empresa->modalidad }}" />
                    </div>

                    <div>
                        <x-input-label for="familiaPersonal-{{ $index }}" value="Familia Personal" />
                        <x-text-input-light id="familiaPersonal-{{ $index }}" name="familiaPersonal" value="{{ $empresa->familiaPersonal }}" />
                    </div>

                    <div>
                        <x-input-label for="ofertaLaboral-{{ $index }}" value="Oferta Laboral" />
                        <x-text-input-light id="ofertaLaboral-{{ $index }}" name="ofertaLaboral" value="{{ $empresa->ofertaLaboral }}" />
                    </div>
                </div>

                <div class="md:col-span-1 space-y-4">
                    <div>
                        <x-input-label for="entidad-{{ $index }}" value="Entidad" />
                        <x-text-input-light id="entidad-{{ $index }}" name="entidad" value="{{ $empresa->entidad }}" />
                    </div>

                    <div>
                        <x-input-label for="comunidad-{{ $index }}" value="Comunidad" />
                        <x-text-input-light id="comunidad-{{ $index }}" name="comunidad" value="{{ $empresa->comunidad }}" />
                    </div>

                    <div>
                        <x-input-label for="provincia-{{ $index }}" value="Provincia" />
                        <x-text-input-light id="provincia-{{ $index }}" name="provincia" value="{{ $empresa->provincia }}" />
                    </div>

                    <div>
                        <x-input-label for="municipio-{{ $index }}" value="Municipio" />
                        <x-text-input-light id="municipio-{{ $index }}" name="municipio" value="{{ $empresa->municipio }}" />
                    </div>

                    <div>
                        <x-input-label for="direccion-{{ $index }}" value="Dirección" />
                        <x-text-input-light id="direccion-{{ $index }}" name="direccion" value="{{ $empresa->direccion }}" />
                    </div>

                    <div>
                        <x-input-label for="codigoPostal-{{ $index }}" value="Código Postal" />
                        <x-text-input-light id="codigoPostal-{{ $index }}" name="codigoPostal" value="{{ $empresa->codigoPostal }}" />
                    </div>

                    <div>
                        <x-input-label for="observaciones-{{ $index }}" value="Observaciones" />
                        <x-text-input-light id="observaciones-{{ $index }}" name="observaciones" value="{{ $empresa->observaciones }}" />
                    </div>
                </div>
                
                <div class="md:col-span-2 flex justify-end gap-4">
                    <button type="button" class="cancel-edit-btn" data-target="empresa-{{ $index }}">
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
    });
</script>