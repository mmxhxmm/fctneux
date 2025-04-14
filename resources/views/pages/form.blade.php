<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Formulario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow sm:rounded-lg bg-blue">
                <div class="w-full flex justify-center">
                    <div class="w-[30em]">
                        @include("pages.partials.{$form}")
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>