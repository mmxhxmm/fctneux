<section id="myModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="w-full max-w-5xl bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-blue">
        <!-- Modal Header -->
        <div class="bg-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Datos del Usuario</h2>
            <button id="closeModal" class="closeModal text-white text-xl hover:text-orange transition-all">✕</button>
        </div>

        <div class="px-10 py-8">
            <form method="POST" action="{{ route('user.add') }}" class="space-y-6 font-roboto text-gray-800" autocomplete="off">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Nombre <span class='text-red-500'>*</span>" />
                        <x-text-input-light type="text" name="name" id="name" value="{{ old('name') }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" value="Corréo Electrónico <span class='text-red-500'>*</span>" />
                        <x-text-input-light type="email" name="email" id="email" value="{{ old('email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="role" value="Nivel de acceso" />
                        <x-select-input-light name="role" id="role">
                            <option value="coordinador">Coordinador</option>
                            <option value="registrador">Registrador</option>
                            <option value="admin">Admin</option>
                        </x-select-input-light>
                    </div>
                    <div>
                        <x-input-label for="municipio" value="Municipio" />
                        <x-select-input-light name="municipio" id="municipio">
                            <option value="barcelona">Barcelona</option>
                            <option value="madrid">Madrid</option>
                            <option value="valencia">Valencia</option>
                        </x-select-input-light>
                    </div>
                    <div>
                        <x-input-label for="situacion" value="Situación" />
                        <x-select-input-light name="situacion" id="situacion">
                            <option value="alta">Alta</option>
                            <option value="baja">Baja</option>
                        </x-select-input-light>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="password" value="Password <span class='text-red-500'>*</span>" />
                        <x-text-input-light type="text" name="password" id="password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="telefono" value="Teléfono" />
                        <x-text-input-light type="tel" name="telefono" id="telefono" maxlength="9" value="{{ old('telefono') }}" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-6 pt-6">
                    <button type="button" class="closeModal">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="bg-blue hover:bg-blue-700 transition text-white font-semibold px-5 py-2 rounded-full shadow-sm">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>