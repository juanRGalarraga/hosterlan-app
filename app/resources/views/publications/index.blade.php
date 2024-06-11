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
    <script src="/js/publications/index.js"></script>
    @endpush

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <div class="flex flex-row pl-3 mt-3 w-fit">
        
        @include('publications.index-filters')
        
        <!-- <div class="flex flex-wrap justify-center mt-3 w-full"> -->
        <div class="grid grid-cols-3 gap-2" id="card-list">
            @forelse($publications as $publication)
                <div>
                    <x-booking-card class="hover:cursor-pointer clickeable-card" :imageSource="$publication->getFirstPicture()" :title="__($publication->title)" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
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