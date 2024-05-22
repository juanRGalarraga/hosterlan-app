<x-publication.publication-layout>

    @push('custom-scripts')
        <script src="/js/publications/create.js"></script>
    @endpush

    @push('custom-css')
        <link rel="stylesheet" href="/css/publications/create.css">
    @endpush

    @push('calendar-js')
        <script src="/js/calendar/jsCalendar.min.js"></script>
        <script src="/js/calendar/jsCalendar.lang.es.js"></script>
        <script src="/js/calendar/jsCalendar.datepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.min.css">
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.darkseries.min.css">
    @endpush

    <div class="text-white flex flex-row p-3">
        <div class="basis-1/2" id="description">
            <div id="publisher"></div>
            <div id="picture">
                <div id="dropzone"></div>
            </div>

            <div class="flex flex-row max-w-2xl mx-auto space-x-3 justify-center mb-3">
                <x-form.datepicker-input :label="__('Desde')"></x-form.datepicker-input>
                <x-form.datepicker-input :label="__('Hasta')"></x-form.datepicker-input>
            </div>

            <x-form.select-input id="rentType" label="{{__('Tipo de renta')}}" placeholder="Tipo de renta">
                <x-form.select-input-option value="Rent1">Rent1</x-form.select-input-option>
                <x-form.select-input-option value="Rent2">Rent2</x-form.select-input-option>
                <x-form.select-input-option value="Rent3">Rent3</x-form.select-input-option>
            </x-form.select-input>

            <x-form.minimal-input id="roomCount" type="number" label="{{__('Número de habitaciones')}}"></x-form-minimal-input>

            <x-form.minimal-input id="bathCount" type="number" label="{{__('Número de baños')}}"></x-form-minimal-input>

            <x-form.minimal-input id="monthPrice" type="number" label="{{__('Precio por mes')}}"></x-form-minimal-input>

            <x-form.minimal-input id="propertyAddress" type="number" label="{{__('Direccion de la propiedad')}}"></x-form-minimal-input>
            
            <x-form.minimal-input id="propertyDescription" type="text" label="{{__('Descripción del alquiler')}}"></x-form-minimal-input>
        </div>
        <div class="">
            
        </div>
    </div>
</x-publication.publication-layout>