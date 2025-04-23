<x-app-layout>
    <section class="bg-white overflow-hidden">
        <section class="relative bg-cover bg-center bg-fixed mb-16" style="background-image: url('../images/Group 58.png');">
            @if(is_countable($users) && count($users) > 0)
                @foreach ($users as $key => $user)
                    @if (Auth::user()->id == $user->id)
                        <!-- User Name Badge -->
                        <div class="absolute left-[31%] transform -translate-x-1/2 md:top-[31%] w-fit">
                            <div class="bg-gradient-to-r from-orange to-orange/80 shadow-lg rounded-full px-6 py-2">
                                <h1 class="text-white text-center text-xl font-semibold tracking-wide uppercase">
                                    {{ $user->role }}
                                </h1>
                            </div>
                        </div>

                        <!-- Info and Tasks -->
                        <section class="pt-[7%]">
                            <div class="md:mx-[9%] sm:mx-[3%] p-6">
                                <div class="flex flex-col md:flex-row md:gap-12 w-full">

                                    <!-- User Info Card -->
                                    <div class="bg-primary text-white rounded-xl shadow-lg p-8 sm:w-full md:w-[50%] h-auto">
                                        <h2 class="text-3xl font-bold mt-3 mb-12"> Usuario</h2>

                                        <div class="space-y-4 text-base">
                                            <p><strong>Nombre:</strong> <span class="float-right">{{ $user->name }}</span></p>
                                            <p><strong>Provincia:</strong> <span class="float-right">{{ $user->municipio }}</span></p>
                                            <p><strong>Teléfono:</strong> <span class="float-right">{{ $user->telefono }}</span></p>
                                            <p><strong>Correo:</strong> <span class="float-right">{{ $user->email }}</span></p>
                                            <p><strong>Situación:</strong> <span class="float-right">{{ $user->situacion }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Tareas Pendientes -->
                                    <input type="checkbox" id="toggle" class="hidden peer" />
                                    <div class="w-full bg-white border-[6px] border-primary p-6 rounded-2xl shadow-lg mt-8 peer-checked:h-auto transition-all duration-500">
                                        <h3 class="text-2xl text-primary font-bold text-center mb-6"> Tareas Pendientes</h3>

                                        <ul class="space-y-4">
                                        @if(is_countable($tareas) && count($tareas) > 0)
                                            @foreach ($tareas->take(6) as $i => $tarea)
                                                <li class="flex items-center text-orange font-semibold {{ $i >= 4 ? 'hidden peer-checked:flex' : '' }}">
                                                    <div class="w-8 h-8 flex items-center justify-center bg-orange text-white rounded-full text-lg">!</div>
                                                    <span class="ml-3">{{ $tarea->nombre }}</span>
                                                    <span>{{ $tarea->fecha_limite }}</span>
                                                    <span>{{ $tarea->descripcion }}</span>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="text-center text-gray-600">No hay tareas pendientes.</li>
                                        @endif
                                        </ul>

                                        <!-- Toggle Button -->
                                        <div class="flex justify-center mt-6">
                                            <label for="toggle" class="cursor-pointer flex items-center gap-2 text-white bg-orange hover:bg-orange-600 px-5 py-2 rounded-full shadow-md transition-all">
                                                <img class="w-5 peer-checked:hidden" src="../images/flecha-hacia-abajo.png" alt="Mostrar más">
                                                <img class="w-5 hidden peer-checked:block" src="../images/flecha-hacia-arriba.png" alt="Mostrar menos">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endforeach
            @else
                <p class="text-center py-10 text-gray-600">No users found.</p>
            @endif
        </section>
    </section>
</x-app-layout>
