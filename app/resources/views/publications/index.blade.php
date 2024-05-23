<x-app-layout>

    @push('calendar-js')
        <script src="/js/calendar/jsCalendar.min.js"></script>
        <script src="/js/calendar/jsCalendar.lang.es.js"></script>
        <script src="/js/calendar/jsCalendar.datepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.min.css">
        <link rel="stylesheet" type="text/css" href="/css/calendar/jsCalendar.darkseries.min.css">
    @endpush

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <div class="flex">
        <div class="w-[20%] pl-3 mt-3">

            <x-form.minimal-input label="Buscar" class="mb-3" type="text" id="buscador"></x-form.minimal-input>

            <x-form.select-input id="" label="{{__('Ordenar por')}}" class="mb-3">
                <x-form.select-input-option value="Opcion1">Opcion1</x-form.select-input-option>
                <x-form.select-input-option value="Opcion2">Opcion2</x-form.select-input-option>
                <x-form.select-input-option value="Opcion3">Opcion3</x-form.select-input-option>
                <x-form.select-input-option value="Etc">Etc</x-form.select-input-option>
            </x-form.select-input>

            <x-form.label text="Disponibilidad"></x-form.label>
            <div class="flex flex-row mb-3">
                <x-form.datepicker-input :label="__('Desde')" class="text-white max-w-[50%]"></x-form.datepicker-input>
                <x-form.datepicker-input :label="__('Hasta')" class="text-white max-w-[50%]"></x-form.datepicker-input>
            </div>

            <x-form.label text="Precio"></x-form.label>
            <div class="flex flex-row mb-3">
                <x-form.minimal-input class="mb-3 w-[50%]" type="text" id="" placeholder="Min."></x-form.minimal-input>
                <span>a</span>
                <x-form.minimal-input class="mb-3 w-[50%]" type="text" id="" placeholder="Máx."></x-form.minimal-input>
            </div>

            <x-form.select-input id="" label="{{__('Habitaciones')}}" class="mb-3">
                <x-form.select-input-option value="Opcion1">Opcion1</x-form.select-input-option>
                <x-form.select-input-option value="Opcion2">Opcion2</x-form.select-input-option>
                <x-form.select-input-option value="Opcion3">Opcion3</x-form.select-input-option>
                <x-form.select-input-option value="Etc">Etc</x-form.select-input-option>
            </x-form.select-input>

            <x-form.select-input id="" label="{{__('Baños')}}" class="mb-3">
                <x-form.select-input-option value="Opcion1">Opcion1</x-form.select-input-option>
                <x-form.select-input-option value="Opcion2">Opcion2</x-form.select-input-option>
                <x-form.select-input-option value="Opcion3">Opcion3</x-form.select-input-option>
                <x-form.select-input-option value="Etc">Etc</x-form.select-input-option>
            </x-form.select-input>

            <x-form.select-input id="" label="{{__('Tipo de renta')}}" class="mb-3">
                <x-form.select-input-option value="Rent1">Rent1</x-form.select-input-option>
                <x-form.select-input-option value="Rent2">Rent2</x-form.select-input-option>
                <x-form.select-input-option value="Rent3">Rent3</x-form.select-input-option>
            </x-form.select-input>

            <x-form.label text="Metros cuadrados"></x-form.label>
            <div class="flex flex-row mb-3">
                <x-form.minimal-input class="mb-3 w-[50%]" type="text" id="" placeholder="Min."></x-form.minimal-input>
                <span>a</span>
                <x-form.minimal-input class="mb-3 w-[50%]" type="text" id="" placeholder="Máx."></x-form.minimal-input>
            </div>

            <x-form.toggle-switch label="Permite mascotas"></x-form.toggle-switch>
        </div>
        <div class="w-[80%] flex flex-wrap justify-center mt-3">
            @forelse($publications as $publication)
                <div>
                    <x-booking-card class="ml-3" :title="__($publication->title)" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
                </div>
            @empty
                <span class="text-danger">
                    <strong>{{__('No se encontraron publicaciones')}}</strong>
                </span>
            @endforelse
        </div>
    </div>
    <div class="text-center justify-center flex flex-shrink-2">
        {{$publications->links()}}
    </div>
</x-app-layout>