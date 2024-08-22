<x-app-layout>
    @push('calendar-js')
        <script src="/js/calendar/jsCalendar.min.js"></script>
        <script src="/js/calendar/jsCalendar.lang.es.js"></script>
        <script src="/js/calendar/jsCalendar.datepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.min.css">
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.darkseries.min.css">
    @endpush

    @push('custom-css')
        <link rel="stylesheet" type="text/css" href="/css/publications/index.css??v={{time()}};">
    @endpush

    @push('custom-scripts')
    <script src="/js/publications/index.js?v={{time()}}"></script>
    <script src="/js/publications/index-filter.js?v={{time()}}"></script>
    @endpush

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <div class="pl-3 mt-3 w-fit relative">
        <div class="w-full px-4">
            @include('publications.index-filters')
        </div>
        
        <!-- <div class="flex flex-wrap justify-center mt-3 w-full"> -->
        <div class="w-full grid grid-cols-4 grid-flow-row" id="publicationMainlist">
            @include('publications.list')
        </div>
    </div>
    <div class="text-center flex justify-center w-full">
        {{$publications->links()}}
    </div>
</x-app-layout>