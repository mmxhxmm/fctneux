<x-app-layout>
    @foreach ($empresas as $empresa)
        @if ($empresa->id == $id)
            <div class="relative h-[300px] flex-grow-0 flex-shrink-0" style="background-image: url('../images/bg-details.png'); background-size: cover; background-position: center;">
                <div class="w-full h-full flex flex-col  absolute px-4 ">
                    <div class="absolute left-0 top-[4em] animate-left">
                        <a href="{{ route('empresa-index') }}" class="justify-start p-2 px-4 rounded-tl-[0px] rounded-tr-[50px] rounded-br-[50px] rounded-bl-[0px] bg-orange w-[250px] h-[40px] hover:text-white hover:border-none text-[16px] text-white text-left flex-grow-0 mb-6 "><<< Volver a las empresas</a>
                    </div>

                    <div class="text-center justify-center mt-20 fade-in">
                        <p class="text-white text-three " style="text-shadow: 2px 4px 2px rgba(0,0,0,0.40)">
                            Detalles de <span class="text-two font-roboto_condensed_bold tracking-wide text-orange">{{ $empresa->nombre }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="relative">
                <!-- Sticky Button -->
                <button 
                    id="toggleTareasBtn"
                    class="z-[20] fixed right-2 px-4 py-3 rounded-full text-white hover:text-blue border border-blue bg-blue hover:bg-white transition active:scale-95 duration-80"
                >
                    Tareas >
                </button>

                <!-- Overlay (hidden by default) -->
                <div id="panelOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>

                <!-- Task Details Panel (Initially off-screen) -->
                <div id="tareaDetailPanel" class="fixed inset-y-0 right-0 w-2/3 bg-white shadow-xl transform translate-x-full transition-transform duration-300 z-40">
                    <div class="h-full flex flex-col">
                        <!-- Panel Header -->
                        <div class="p-4 h-[10vh] bg-blue text-white border-b flex justify-between items-center">
                            <h2 class="text-xl font-bold">Datos de Tareas</h2>
                            <button id="closePanelBtn" class="text-gray-500 hover:text-gray-700 text-2xl">
                            &times;
                            </button>
                        </div>
                        
                        <!-- Panel Content -->
                        <div class="flex-1 overflow-y-auto p-4">
                            @include("pages.empresa.partials.tarea-detail", ['empresa' => $empresa])
                        </div>
                    </div>
                </div>
            </div>

            <div class=" mx-auto sm:px-6 lg:px-8 space-y-6 ">
                @include("pages.partials.{$page}")
            </div>

            <div class="relative h-[250px] flex-grow-0 flex-shrink-0" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 15), rgba(255, 255, 255, 0) ), url('../images/bg-details-btm.png'); background-size: cover; background-position: center;">
            </div>
        @endif
    @endforeach
</x-app-layout>


<script>
  // Toggle panel
  document.getElementById('toggleTareasBtn').addEventListener('click', function() {
    document.getElementById('panelOverlay').classList.remove('hidden');
    document.getElementById('tareaDetailPanel').classList.remove('translate-x-full');
  });

  // Close panel
  document.getElementById('closePanelBtn').addEventListener('click', closePanel);
  document.getElementById('panelOverlay').addEventListener('click', closePanel);

  function closePanel() {
    document.getElementById('tareaDetailPanel').classList.add('translate-x-full');
    document.getElementById('panelOverlay').classList.add('hidden');
  }

  // Close with Escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePanel();
  });
</script>