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

    <div class="flex flex-row">
        <div class="w-64 px-4 overflow-y-auto fixed-filters-zone show-scroll space-x-2" id="description">
            @include('publications.create-form')
        </div>
        <div id="preview" class="w-1/2 bg-gray-900 p-6 rounded-lg text-white">
            @include('publications.create-preview')
        </div>
    </div>
</x-app-layout>
