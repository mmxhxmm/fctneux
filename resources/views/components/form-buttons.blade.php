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

<div>
    <div class="flex items-center gap-4 pt-12 pb-4" id="bottom">
        <!-- Exit Button -->
        <!-- To go to Controller -->
        <!-- <x-primary-button 
            name="action" 
            value="exit" 
            aria-label="Salir del formulario">
            {{ __('Exit') }}
        </x-primary-button> -->
        <x-primary-nonsubmit-button type="button" value="exit" 
            onclick="window.location.href='{{ route('empresa-index') }}?status={{ urlencode($status) }}'"
            aria-label="Salir del formulario">
                {{ __('Exit') }}
        </x-primary-button>

        <!-- Reset Button -->
        <x-primary-nonsubmit-button 
            type="button"
            value="reset"
            onclick="if (confirm('¿Eliminar toda la información?')) {
                fetch ('{{ route('clear-drafts') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => window.location.reload());
            }" 
            aria-label="Resetear el formulario">
            {{ __('Reset') }}
        </x-primary-nonsubmit-button>

        <!-- Publish Button -->
        <x-primary-button 
            name="action" 
            value="publish"
            onclick="return confirm('¿Quieres publicar toda la información introducida?')"
            aria-label="Guardar la Empresa y salir">
            {{ __('Guardar') }}
        </x-primary-button>
    </div>

    <div class="flex items-center gap-4 pb-4">
        <!-- Delete Draft Button (Conditional) -->
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
                aria-label="Eliminar el draft">
                {{ __('Delete Draft') }}
            </x-primary-nonsubmit-button>
        @endif

        <!-- Save Draft Button -->
        <x-primary-button 
            name="action" 
            value="save_draft" 
            aria-label="Guardar el draft">
            {{ __('Guardar Draft') }}
        </x-primary-button>
    </div>

    <div class="flex items-center gap-4">
        <!-- Previous Page Button (Displays from 2 and onwards) -->
        @if((intval(explode('-', $currentRoute)[2]) - 1) >= 1)
            <x-primary-button 
                name="action" 
                value="prev_page" 
                aria-label="Volver a la página anterior">
                {{ __('Página Anterior') }}
            </x-primary-button>
        @endif

        <!-- Next Page Button -->
        <x-primary-button 
            name="action" 
            value="next_page" 
            aria-label="Ir a la siguiente página">
            {{ __('Siguiente Página') }}
        </x-primary-button>
    </div>

    <!-- Status Message -->
    <div id="status" class="pt-4">
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