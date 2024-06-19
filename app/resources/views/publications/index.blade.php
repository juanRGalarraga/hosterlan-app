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
    @endpush

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <div class="flex flex-row pl-3 mt-3 w-fit">
        
        @include('publications.index-filters')
        
        <!-- <div class="flex flex-wrap justify-center mt-3 w-full"> -->
        <div class="grid grid-cols-3 gap-2" id="publicationMainlist">
            @include('publications.list')
        </div>
    </div>
    <div class="text-center flex justify-between">
        {{$publications->links()}}
    </div>
</x-app-layout>