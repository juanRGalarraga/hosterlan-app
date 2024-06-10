<x-app-layout>
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
            <form id="publicationForm" action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="publisher"></div>
                <div id="picture">
                    <div id="dropzone">
                        <input type="text" name="nico" id="nico" accept="nico">
                    </div>
                </div>



                <div class="flex flex-row max-w-2xl mx-auto space-x-3 justify-center mb-3">
                    <x-form.datepicker-input name="start_date" :label="__('Desde')" id="start_date"></x-form.datepicker-input>
                    <x-form.datepicker-input name="end_date" :label="__('Hasta')" id="end_date"></x-form.datepicker-input>
                </div>

                <x-form.select-input name="rent_type" id="rentType" label="{{__('Tipo de renta')}}" placeholder="Tipo de renta">
                    <x-form.select-input-option value="Rent1">Rent1</x-form.select-input-option>
                    <x-form.select-input-option value="Rent2">Rent2</x-form.select-input-option>
                    <x-form.select-input-option value="Rent3">Rent3</x-form.select-input-option>
                </x-form.select-input>

                <x-form.minimal-input name="room_count" id="roomCount" type="number" label="{{__('Número de habitaciones')}}"></x-form.minimal-input>

                <x-form.minimal-input name="bath_count" id="bathCount" type="number" label="{{__('Número de baños')}}"></x-form.minimal-input>

                <x-form.minimal-input name="price" id="monthPrice" type="number" label="{{__('Precio')}}"></x-form.minimal-input>

                <x-form.minimal-input name="ubication" id="propertyAddress" type="text" label="{{__('Dirección de la propiedad')}}"></x-form.minimal-input>
                
                <x-form.minimal-input name="description" id="propertyDescription" type="text" label="{{__('Descripción del alquiler')}}"></x-form.minimal-input>

                <x-form.select-input name="pets" id="pets" label="{{__('Se aceptan mascotas')}}">
                    <x-form.select-input-option value="yes">Sí</x-form.select-input-option>
                    <x-form.select-input-option value="no">No</x-form.select-input-option>
                </x-form.select-input>

                <x-form.minimal-input name="image" id="image" type="file" accept="image/*" label="{{__('imagen de la propiedad')}}"></x-form.minimal-input>

                <button type="submit" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out" title="Publicar">{{ __('Publicar') }}</button>
            </form>
        </div>
        <div id="preview" class="basis-1/2">
           >
        </div>
    </div>
</x-app-layout>

