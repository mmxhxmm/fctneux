<section id="myModal" class="fixed inset-0 flex bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white border-2 border-blue w-[60%] h-auto rounded-lg">
        <div class="relative">
            <div class="bg-blue text-white text-center p-2 text-four">Datos de Tareas</div>
                <div class="p-8 flex justify-between items-start">
                    <div class="w-[45%]">
                        <iframe src="https://calendar.google.com/calendar/embed?src=your-calendar-id&ctz=America%2FNew_York"
                                width="100%" height="400px" frameborder="0" scrolling="no"></iframe>
                    </div>

                    <div class="w-[50%]">
                        <form method="POST" id="taskForm" action="{{ route('tareas-store') }}" class="w-full flex flex-col gap-y-3">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-input-label-light for="nombre" :value="__('Nombre de tarea <span class=\'text-red-500\'>*</span>')" />
                                <x-text-input-light type="text" id="nombre" name="nombre" value="{{ old('nombre', session('tarea')?->nombre) }}" class="mt-1 block w-full" autocomplete="off" required />
                                <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                            </div>

                            <!-- TODO: Replace this with multiple select -->
                            <div>
                                <x-input-label-light for="empresa_id" :value="__('Empresa associada <span class=\'text-red-500\'>*</span>')" />
                                <x-text-input-light type="number" id="empresa_id" name="empresa_id" value="{{ old('empresa_id', session('tarea')?->empresa_id) }}" min=1 class="mt-1 block w-full" autocomplete="off" required />
                                <x-input-error :messages="$errors->get('empresa_id')" class="mt-2" />
                            </div>

                            <!-- TODO: Replace this with multiple select -->
                            <div>
                                <x-input-label-light for="asignado" :value="__('Asignado a')" />
                                <x-text-input-light type="text" id="asignado" name="asignado" value="{{ old('asignado', session('tarea')?->asignado) }}" class="mt-1 block w-full" autocomplete="off" />
                                <x-input-error :messages="$errors->get('asignado')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label-light for="estado" :value="__('Estado')" />
                                <x-select-input name="estado" id="estado" class="mt-1 block w-full">
                                    <x-session-option 
                                        value="to_do" 
                                        :selectedValue="old('estado', session('tarea')?->estado)" 
                                        label="Por hacer"
                                    />
                                    <x-session-option 
                                        value="in_progress" 
                                        :selectedValue="old('estado', session('tarea')?->estado)" 
                                        label="En progreso"
                                    />
                                    <x-session-option 
                                        value="revision" 
                                        :selectedValue="old('estado', session('tarea')?->estado)" 
                                        label="En revisión"
                                    />
                                    <x-session-option 
                                        value="blocked" 
                                        :selectedValue="old('estado', session('tarea')?->estado)" 
                                        label="Bloqueado"
                                    />
                                    <x-session-option 
                                        value="done" 
                                        :selectedValue="old('estado', session('tarea')?->estado)" 
                                        label="Completada"
                                    />
                                </x-select-input>
                            </div>

                            <div>
                                <x-input-label-light for="descripcion" :value="__('Descripción')" />
                                <textarea id="descripcion" name="descripcion" value="{{ old('descripcion', session('tarea')?->descripcion) }}" rows="3" class="mt-1 block w-full border-gray-300 focus:border-blue focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label-light for="fecha_limite" :value="__('Fecha Límite')" />
                                <x-text-input-light type="date" id="fecha_limite" name="fecha_limite" value="{{ old('fecha_limite', session('tarea')?->fecha_limite) }}" class="mt-1 block w-full" autocomplete="off" />
                                <x-input-error :messages="$errors->get('fecha_limite')" class="mt-2" />
                            </div>

                            <div class="flex gap-4 mt-4 justify-end">
                                <button type="reset" class="bg-orange text-white p-3 px-6 rounded-lg" aria-label="Resetear el formualrio">
                                    Reset
                                </button>
                                <button type="submit" id="saveTask" class="bg-blue text-white p-3 px-6 rounded-lg" aria-label="Enviar el formualrio">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- Close Button -->
            <button id="closeModal" class="absolute top-0 w-10 h-10 right-0 bg-orange text-white rounded-[100px] m-2">X</button>
        </div>
    </div>
</section>