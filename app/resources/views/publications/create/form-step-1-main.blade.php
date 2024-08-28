<x-app-layout :includeSearchNav="false">
    <x-slot:scripts>
        @vite([
            'resources/js/publications/create/main.js',
            'resources/css/publications/create/create.css',
        ])
    </x-slot:scripts>

    <x-slot:header>
        {{__('Publicar propiedad')}}
    </x-slot:header>

    <div class="flex flex-row my-max-h-screen">
        @include('publications.create.form-step-1')
    </div>
</x-app-layout>