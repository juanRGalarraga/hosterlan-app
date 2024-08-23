<x-app-layout :includeSearchNav="false">
    <x-slot:scripts>
        @vite(['resources/js/publication/create/dropzone.js'])
    </x-slot:scripts>

    @push('custom-css')
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.min.css">
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.darkseries.min.css">
        <link rel="stylesheet" href="/css/publications/create.css">
    @endpush

    <x-slot:header>
        {{__('Publicar propiedad')}}
    </x-slot:header>

    <div class="flex flex-row my-max-h-screen">
        @include('publications.create.form')
    </div>
</x-app-layout>
