<x-app-layout>

    @push('calendar-js')
        <script src="/js/calendar/jsCalendar.min.js"></script>
        <script src="/js/calendar/jsCalendar.lang.es.js"></script>
        <script src="/js/calendar/jsCalendar.datepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.min.css">
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.darkseries.min.css">
    @endpush

    @push('custom-css')
        <link rel="stylesheet" type="text/css" href="/css/publications/index.css">
    @endpush

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <div class="flex flex-row">
        
        <div class="pl-3 mt-3 w-fit">
            @include('publications.index-filters')
        </div>
        
        <div class="flex flex-wrap justify-center mt-3 w-full">
            @forelse($publications as $publication)
                <div class="hover:cursor-pointer">
                    <x-booking-card class="ml-3" :title="__($publication->title)" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
                </div>
            @empty
                <span class="text-danger">
                    <strong>{{__('No se encontraron publicaciones')}}</strong>
                </span>
            @endforelse
        </div>
    </div>
    <div class="text-center flex justify-between">
        {{$publications->links()}}
    </div>
</x-app-layout>