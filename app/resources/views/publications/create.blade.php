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

    <div class="text-white flex flex-row p-3 space-x-4 bg-gray-800 min-h-screen">
        <div class="w-1/2 bg-gray-900 p-6 rounded-lg" id="description">
            <form id="publicationForm" action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

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

                <x-form.minimal-input name="ubication" id="propertyAddress" type="text" label="{{__('Ubicación de la propiedad')}}"></x-form.minimal-input>

                <div>
                    <label for="propertyDescription" class="block text-sm font-medium text-gray-300">{{__('Descripción del alquiler')}}</label>
                    <textarea name="description" id="propertyDescription" cols="10" rows="3" class="w-full text-gray-900 bg-gray-200 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-white dark:border-gray-600"></textarea>
                </div>
                <x-form.select-input name="pets" id="pets" label="{{__('Se aceptan mascotas')}}">
                    <x-form.select-input-option value="si">Sí</x-form.select-input-option>
                    <x-form.select-input-option value="no">No</x-form.select-input-option>
                </x-form.select-input>

                <input  name="image" id="image" type="file"  multiple="multiple" accept="image/*" label="{{__('Imagen')}}"></input>

                <button type="submit" class="inline-flex items-center justify-center p-2 rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 transition duration-150 ease-in-out">{{ __('Publicar') }}</button>
            </form>
        </div>
        <div id="preview" class="w-1/2 bg-gray-900 p-6 rounded-lg text-white">
            
        </div>
    </div>
</x-app-layout>
