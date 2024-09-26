<x-app-layout :includeSearchNav="false">
    <x-slot:scripts>
        @vite([
            'resources/js/publications/edit/main.js',
        ])
    </x-slot:scripts>

    <x-slot:header>
        {{__('Editar propiedad')}}
    </x-slot:header>

    <div class="flex flex-row my-max-h-screen">
        @include('publications.edit.form')
    </div>
</x-app-layout>