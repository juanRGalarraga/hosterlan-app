<x-app-layout>
    @push('custom-scripts')
        <script src="/js/calendar/jsCalendar.min.js"></script>
        <script src="/js/calendar/jsCalendar.lang.es.js"></script>
        <script src="/js/calendar/jsCalendar.datepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.min.css">
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.darkseries.min.css">
        <script src="/js/publications/create.js?v={{time()}}"></script>
    @endpush

    @push('custom-css')
        <link rel="stylesheet" href="/css/publications/create.css">
    @endpush

    <x-slot:header>
        {{__('Publicar propiedad')}}
    </x-slot:header>

    <div class="flex flex-row my-max-h-screen">
        @include('publications.create-form')
        @include('publications.create-preview')
    </div>
</x-app-layout>
