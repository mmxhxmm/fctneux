<section class="flex flex-col space-y-12">
    @foreach ($empresa->responsablesConvenio as $index => $resConv)
    <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
        <!-- Toggleable Edit Button -->
        <button 
            id="edit-btn-res-conv-{{ $index }}"
            type="button" 
            class="edit-btn absolute px-2 rounded top-6 right-6 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-target="res-conv-{{ $index }}"> Editar
        </button>
        
        <!-- Display Mode -->
        <div id="display-res-conv-{{ $index }}">
            <h3 class="text-xl font-semibold text-blue mb-8">Responsable de Convenio - {{ $resConv->nombre }} {{ $resConv->apellido }}</h3>
            <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                <p><strong>DNI:</strong> {{ $resConv->dni }}</p>
                <p><strong>Nombre:</strong> {{ $resConv->nombre }} {{ $resConv->apellido }}</p>
                <p><strong>Teléfono:</strong> {{ $resConv->telefono }}</p>
                <p><strong>Email:</strong> {{ $resConv->email }}</p>
            </div>
        </div>
        
        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-res-conv-{{ $index }}" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-8">Editar Responsable Convenio - {{ $resConv->nombre }} {{ $resConv->apellido }}</h3>
            <form method="POST" action="{{ route('responsables.update', $resConv->id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')
                
                <div>
                    <x-input-label for="dni-{{ $index }}" value="DNI <span class='text-red-500'>*</span>" />
                    <x-text-input-light id="dni-{{ $index }}" name="dni" value="{{ $resConv->dni }}" />
                </div>
                
                <div>
                    <x-input-label for="nombre-{{ $index }}" value="Nombre <span class='text-red-500'>*</span>" />
                    <x-text-input-light id="nombre-{{ $index }}" name="nombre" value="{{ $resConv->nombre }}" />
                </div>
                
                <div>
                    <x-input-label for="apellido-{{ $index }}" value="Apellido <span class='text-red-500'>*</span>" />
                    <x-text-input-light id="apellido-{{ $index }}" name="apellido" value="{{ $resConv->apellido }}" />
                </div>
                
                <div>
                    <x-input-label for="telefono-{{ $index }}" value="Teléfono" />
                    <x-text-input-light id="telefono-{{ $index }}" name="telefono" value="{{ $resConv->telefono }}" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                </div>
                
                <div>
                    <x-input-label for="email-{{ $index }}" value="Email" />
                    <x-text-input-light id="email-{{ $index }}" name="email" value="{{ $resConv->email }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <div class="md:col-span-3 flex justify-between gap-4 mt-4">
                    <button type="button" onclick="confirmDeleteRC({{ $resConv->id }})" class="bg-red-500 text-white px-4 py-2 rounded">
                        Eliminar
                    </button>
                
                    <div class="flex gap-6">
                        <button type="button" class="cancel-edit-btn" data-target="res-conv-{{ $index }}">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-blue text-white px-4 py-2 rounded">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>

            <form id="delete-form-ct-{{ $resConv->id }}" method="POST" action="{{ route('responsables.delete', $resConv->id) }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <script>
                function confirmDeleteRC(id) {
                    if (confirm('¿Estás seguro que quieres eliminar este responsable?')) {
                        document.getElementById('delete-form-ct-'+id).submit();
                    }
                }
            </script>
        </div>
    </div>
    @endforeach

    <div>
        <!-- Display Add -->
        <div id="add-display-rc" class="bg-white_dull flex justify-between items-center py-3 px-6 rounded-xl border-l-4 border-blue shadow-sm relative">
            <h3 class="text-xl font-semibold text-blue">Responsable de Convenio</h3>
            <button 
                id="add-btn-res-conv"
                type="button" 
                class="px-2 rounded text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80">
                Añadir +
            </button>
        </div>

        <!-- Form Add -->
        <div id="add-form-rc" class="hidden bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
            <h3 class="text-xl font-semibold text-blue mb-8">Añadir Responsable de Convenio</h3>
            <form method="POST" action="{{ route('responsables.add', $id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')
                
                <div>
                    <x-input-label for="dni" value="DNI <span class='text-red-500'>*</span>" />
                    <x-text-input-light id="dni" name="dni" />
                </div>
                
                <div>
                    <x-input-label for="nombre" value="Nombre <span class='text-red-500'>*</span>" />
                    <x-text-input-light id="nombre" name="nombre" />
                </div>
                
                <div>
                    <x-input-label for="apellido" value="Apellido <span class='text-red-500'>*</span>" />
                    <x-text-input-light id="apellido" name="apellido" />
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
                    <button type="button" id="cancel-add-btn-rc">
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

        // Add button
        document.getElementById('add-btn-res-conv').addEventListener('click', function() {
            document.getElementById('add-display-rc').classList.add('hidden');
            document.getElementById('add-form-rc').classList.remove('hidden');
        });
        // Cancel Add Button 
        document.getElementById('cancel-add-btn-rc').addEventListener('click', function() {
            document.getElementById('add-display-rc').classList.remove('hidden');
            document.getElementById('add-form-rc').classList.add('hidden');
        });
    });
</script>