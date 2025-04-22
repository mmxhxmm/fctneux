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
                <svg viewBox="0 0 24 24" class="w-5 h-5 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12.0004 9.5L17.0004 14.5M17.0004 9.5L12.0004 14.5M4.50823 13.9546L7.43966 17.7546C7.79218 18.2115 7.96843 18.44 8.18975 18.6047C8.38579 18.7505 8.6069 18.8592 8.84212 18.9253C9.10766 19 9.39623 19 9.97336 19H17.8004C18.9205 19 19.4806 19 19.9084 18.782C20.2847 18.5903 20.5907 18.2843 20.7824 17.908C21.0004 17.4802 21.0004 16.9201 21.0004 15.8V8.2C21.0004 7.0799 21.0004 6.51984 20.7824 6.09202C20.5907 5.71569 20.2847 5.40973 19.9084 5.21799C19.4806 5 18.9205 5 17.8004 5H9.97336C9.39623 5 9.10766 5 8.84212 5.07467C8.6069 5.14081 8.38579 5.2495 8.18975 5.39534C7.96843 5.55998 7.79218 5.78846 7.43966 6.24543L4.50823 10.0454C3.96863 10.7449 3.69883 11.0947 3.59505 11.4804C3.50347 11.8207 3.50347 12.1793 3.59505 12.5196C3.69883 12.9053 3.96863 13.2551 4.50823 13.9546Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                Eliminar borrador
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
                <svg viewBox="0 0 24 24" class="w-5 h-5 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M18.1716 1C18.702 1 19.2107 1.21071 19.5858 1.58579L22.4142 4.41421C22.7893 4.78929 23 5.29799 23 5.82843V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4C1 2.34315 2.34315 1 4 1H18.1716ZM4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21L5 21L5 15C5 13.3431 6.34315 12 8 12L16 12C17.6569 12 19 13.3431 19 15V21H20C20.5523 21 21 20.5523 21 20V6.82843C21 6.29799 20.7893 5.78929 20.4142 5.41421L18.5858 3.58579C18.2107 3.21071 17.702 3 17.1716 3H17V5C17 6.65685 15.6569 8 14 8H10C8.34315 8 7 6.65685 7 5V3H4ZM17 21V15C17 14.4477 16.5523 14 16 14L8 14C7.44772 14 7 14.4477 7 15L7 21L17 21ZM9 3H15V5C15 5.55228 14.5523 6 14 6H10C9.44772 6 9 5.55228 9 5V3Z" fill="#ffffff"></path> </g></svg> 
                Guardar
            </x-primary-button>
        </div>

        <!-- Right: Guardar Borrador -->
        <x-primary-button 
            name="action" 
            value="save_draft" 
            aria-label="Guardar el draft"
            class="px-6 py-2 rounded-full bg-blue hover:none text-white text-sm font-semibold shadow-md hover:shadow-xl transition duration-300">
            <svg viewBox="0 0 24 24" class="w-5 h-5 mr-2" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M13.5 6V10H16M14.6847 2L10 2C8.89543 2 8 2.89543 8 4V16C8 17.1046 8.89543 18 10 18L18 18C19.1046 18 20 17.1046 20 16V7.24162C20 6.7034 19.7831 6.18789 19.3982 5.81161L16.0829 2.56999C15.7092 2.2046 15.2074 2 14.6847 2Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M16 18V20C16 21.1046 15.1046 22 14 22H6C4.89543 22 4 21.1046 4 20V9C4 7.89543 4.89543 7 6 7H8" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            Guardar borrador
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
                Anterior
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
                Siguiente
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
               class="text-sm text-gray-600">
               {{ session('status') }}
            </p>
        @endif
    </div>
</div>
