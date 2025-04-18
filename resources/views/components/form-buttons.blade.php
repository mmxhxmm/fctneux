@props([
    'currentRoute' => null,
    'showDraftDelete' => session()->has('empresa_draft')
])

@php
    $draftKeys = [
        'empresa_draft',
        'responsableConvenio_draft',
        'centroTrabajo_draft',
        'personaContacto_draft',
        'practica_draft',
        'tutor_draft',
        'tutorEmpresa_draft'
    ];
    $status = session()->hasAny($draftKeys) ? 'El draft se ha guardado' : 'Nada se ha guardado';
@endphp

<!-- onclick="window.location.href='{{ route('empresa-index') }}?status={{ urlencode($status) }}'" -->

<!-- Full Button Section -->
<div class="flex flex-col gap-6 pt-10">

        <!-- Action Row -->
    <div class="w-full flex justify-between items-center gap-4 mt-10 flex-wrap">

        <!-- Left: Eliminar Borrador -->
        @if ($showDraftDelete)
            <x-primary-nonsubmit-button 
                type="button" 
                name="action" 
                value="reset_form"
                onclick="if (confirm('¿Quieres eliminar toda la información introducida?')) {
                    fetch('{{ route('clear-drafts') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    }).then(() => window.location.href='{{ $currentRoute ?? route('empresa-form-1') }}');
                }" 
                aria-label="Eliminar el draft"
                class="px-6 py-2 rounded-full bg-red-500 border border-red-500 text-red-600 hover:bg-red-600 hover:shadow-md transition duration-200 ease-in-out text-sm font-semibold">
                🗑️ Eliminar borrador
            </x-primary-nonsubmit-button>
        @endif

        <!-- Center: ¡Guardar! -->
        <div class="">
            <x-primary-button 
                name="action" 
                value="publish"
                onclick="return confirm('¿Quieres publicar toda la información introducida?')"
                aria-label="Guardar la Empresa y salir"
                class="px-7 py-3 rounded-full text-white text-sm font-bold bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 shadow-lg hover:shadow-xl transition-all duration-300">
                ✅ ¡Guardar!
            </x-primary-button>
        </div>

        <!-- Right: Guardar Borrador -->
        <x-primary-button 
            name="action" 
            value="save_draft" 
            aria-label="Guardar el draft"
            class="px-6 py-2 rounded-full bg-blue hover:none text-white text-sm font-semibold shadow-md hover:shadow-xl transition duration-300">
            💾 Guardar borrador
        </x-primary-button>

    </div>

    <!-- Bottom Row: Arrows (unchanged) -->
    <div class="flex justify-center gap-6">
        @if((intval(explode('-', $currentRoute)[2]) - 1) >= 1)
            <x-primary-button 
                name="action" 
                value="prev_page" 
                aria-label="Volver a la página anterior"
                formnovalidate>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </x-primary-button>
        @endif

        @if((intval(explode('-', $currentRoute)[2])) !== 3)
            <x-primary-button 
                name="action" 
                value="next_page" 
                aria-label="Ir a la siguiente página">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </x-primary-button>
        @endif
    </div>

    <!-- Status -->
    <div id="status" class="pt-2 text-center">
        @if (session('status'))
            <p x-data="{ show: true }"
               x-show="show"
               x-transition
               x-init="setTimeout(() => show = false, 2000)"
               class="text-sm text-gray-600 dark:text-gray-400">
               {{ session('status') }}
            </p>
        @endif
    </div>
</div>
