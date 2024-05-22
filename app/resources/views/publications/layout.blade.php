<x-app-layout>
    <x-slot name="head">
        @stack('calendar-js')
        @stack('custom-css')
    </x-slot:head>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear publicacion') }}
        </h2>
    </x-slot>

    {{ $slot }}

    @stack('custom-scripts')

</x-app-layout>
