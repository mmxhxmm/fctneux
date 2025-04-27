<section id="editUserModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="w-full max-w-3xl bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-blue">
        <!-- Modal Header -->
        <div class="bg-blue px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Editar Usuario</h2>
            <button class="closeEditModal text-white text-xl hover:text-orange transition-all">✕</button>
        </div>

        <div class="px-10 py-8">
            <form method="POST" action="" id="userEditForm" class="space-y-6 font-roboto text-gray-800" autocomplete="off">
                @csrf
                @method('PUT')

                <input type="hidden" name="user_id" id="edit_user_id">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="edit_name" value="Nombre <span class='text-red-500'>*</span>" />
                        <x-text-input-light type="text" name="name" id="edit_name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="edit_email" value="Corréo Electrónico <span class='text-red-500'>*</span>" />
                        <x-text-input-light type="email" name="email" id="edit_email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="edit_role" value="Nivel de acceso" />
                        <x-select-input-light name="role" id="edit_role">
                            <option value="coordinador">Coordinador</option>
                            <option value="registrador">Registrador</option>
                            <option value="admin">Admin</option>
                        </x-select-input-light>
                    </div>
                    <div>
                        <x-input-label for="edit_municipio" value="Municipio" />
                        <x-select-input-light name="municipio" id="edit_municipio">
                            <option value="barcelona">Barcelona</option>
                            <option value="madrid">Madrid</option>
                            <option value="valencia">Valencia</option>
                        </x-select-input-light>
                    </div>
                    <div>
                        <x-input-label for="edit_situacion" value="Situación" />
                        <x-select-input-light name="situacion" id="edit_situacion">
                            <option value="alta">Alta</option>
                            <option value="baja">Baja</option>
                        </x-select-input-light>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="edit_password" value="Password (Dejar en blanco para no cambiar)" />
                        <x-text-input-light type="text" name="password" id="edit_password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="edit_telefono" value="Teléfono" />
                        <x-text-input-light type="tel" name="telefono" id="edit_telefono" maxlength="9" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-between gap-6 pt-6">
                    <button type="button" onclick="confirmDeleteUser({{ $user->id }})" class="bg-red-500 text-white px-4 py-2 rounded">
                        Eliminar
                    </button>
                    <div class="flex justify-between gap-6">
                        <button type="button" class="closeEditModal">
                            Cancelar
                        </button>
                        <button type="submit"
                            class="bg-blue hover:bg-blue-700 transition text-white font-semibold px-5 py-2 rounded-full shadow-sm">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </form>
            <form id="delete-user-{{ $user->id }}" method="POST" action="{{ route('user.delete', $user->id) }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <script>
                function confirmDeleteUser(id) {
                    if (confirm('¿Estás seguro que quieres eliminar este usuario?')) {
                        event.preventDefault();
                        document.getElementById(`delete-user-${id}`).submit();
                    }
                }
            </script>
        </div>
    </div>
</section>