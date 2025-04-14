<section class="flex flex-col space-y-12">
    @foreach ($empresa->responsablesConvenio as $index => $resConv)
    <div class="bg-white_dull p-6 rounded-xl border-l-4 border-blue shadow-sm relative">
        <!-- Toggle Button -->
        <button 
            id="edit-btn-{{ $index }}"
            type="button" 
            class="edit-btn absolute px-2 rounded top-4 right-4 text-blue hover:text-white border border-blue hover:bg-blue transition active:scale-95 duration-80"
            data-target="res-conv-{{ $index }}"> Editar
        </button>
        
        <!-- Display Mode -->
        <div id="display-res-conv-{{ $index }}">
            <h3 class="text-xl font-semibold text-blue mb-4">Responsable de Convenio</h3>
            <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                <p><strong>DNI:</strong> {{ $resConv->dni }}</p>
                <p><strong>Nombre Completo:</strong> {{ $resConv->nombre }} {{ $resConv->apellido }}</p>
                <p><strong>Teléfono:</strong> {{ $resConv->telefono }}</p>
                <p><strong>Email:</strong> {{ $resConv->email }}</p>
            </div>
        </div>
        
        <!-- Edit Mode (Hidden by default) -->
        <div id="edit-res-conv-{{ $index }}" class="hidden">
            <h3 class="text-xl font-semibold text-blue mb-4">Editar Responsable Convenio</h3>
            <form method="POST" action="{{ route('responsables.update', $resConv->id) }}" class="grid md:grid-cols-3 gap-6">
                @csrf
                @method('PUT')
                
                <div>
                    <x-input-label for="dni-{{ $index }}" value="DNI" />
                    <x-text-input-light id="dni-{{ $index }}" name="dni" value="{{ $resConv->dni }}" />
                </div>
                
                <div>
                    <x-input-label for="nombre-{{ $index }}" value="Nombre" />
                    <x-text-input-light id="nombre-{{ $index }}" name="nombre" value="{{ $resConv->nombre }}" />
                </div>
                
                <div>
                    <x-input-label for="apellido-{{ $index }}" value="Apellido" />
                    <x-text-input-light id="apellido-{{ $index }}" name="apellido" value="{{ $resConv->apellido }}" />
                </div>
                
                <div>
                    <x-input-label for="telefono-{{ $index }}" value="Teléfono" />
                    <x-text-input-light id="telefono-{{ $index }}" name="telefono" value="{{ $resConv->telefono }}" />
                </div>
                
                <div>
                    <x-input-label for="email-{{ $index }}" value="Email" />
                    <x-text-input-light id="email-{{ $index }}" name="email" value="{{ $resConv->email }}" />
                </div>
                
                <div class="md:col-span-3 flex justify-end gap-4">
                    <button type="button" class="cancel-edit-btn" data-target="res-conv-{{ $index }}">
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
                document.getElementById(`edit-${target}`).classList.toggle('hidden');
                
                this.classList.add('hidden');
                document.getElementById(`cancel-btn-${target}`).classList.remove('hidden');
                document.getElementById(`edit-btn-${target}`).classList.add('hidden');
            });
        });
        
        // Cancel buttons
        document.querySelectorAll('.cancel-edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                
                // Toggle content sections
                document.getElementById(`display-${target}`).classList.remove('hidden');
                document.getElementById(`edit-${target}`).classList.add('hidden');
                
                // Toggle buttons
                this.classList.add('hidden');
                document.getElementById(`edit-btn-${target}`).classList.remove('hidden');
            });
        });
    });
</script>