<x-app-layout :includeSearchNav="false" class=" h-screen">

    <x-slot:scripts>
        @vite([
            'resources/js/publications/edit/main.js',
            'resources/css/main.css',
        ])
    </x-slot:scripts>

    <x-slot:header>
        {{__('Mis propiedades')}}
    </x-slot:header>
    <div class="bg-gray-900 flex justify-center p-10 h-100" id="mainView">
        <form method="GET" action="{{ route('publications.edit.fetch') }}" id="frm-filter-properties" form="frm-filter-properties" class="w-full">
            @csrf
            <div class="mb-4 grid grid-cols-4 gap-2">
                <div class="col-span-1">
                    <x-form.minimal-input inputClass="filter-input" class="mr-2 w-1/2" id="search" name="search" type="text" placeholder="{{__('Buscar')}}"></x-form.minimal-input>
                </div>
                <div class="flex flex-row mb-3 col-span-1">
                    <x-form.minimal-input inputClass="filter-input" class="mr-2" id="price_min" name="price_min" type="text" placeholder="{{__('Precio min.')}}"></x-form.minimal-input>
                    <x-form.minimal-input inputClass="filter-input" id="price_max" name="price_max" type="text" placeholder="{{__('Precio máx.')}}"></x-form.minimal-input>
                </div>
                <div class="flex flex-row mb-3 col-span-1">
                    <x-form.date-range-picker class="filter-input" id="dateRangePicker" idDateFrom="created_at_since" idDateTo="created_at_to"></x-form.flowbite-daterangepicker>
                </div>
                <div class="col-span-1">
                    <button type="button" form="frm-filter-properties" id="filterButton" class="bg-green-400 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                        {{ __('Filtrar') }}
                    </button>
                    <button type="button" form="frm-filter-properties" id="clearFilterButton" class="bg-red-400 text-white font-semibold py-2 px-4 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-opacity-50">
                        {{ __('Borrar') }}
                    </button>
                    <a href="{{route('publications.create.1')}}" class="">
                        {{ __('Crear Publicacion') }}
                    </a>
                </div>
            </div>
            <div id="mainList">

            </div>
        </form>
    </div>

</x-app-layout>
