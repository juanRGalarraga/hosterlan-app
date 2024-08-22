
@php
    use App\Enums\Publication\PublicationState;
    use App\Enums\Publication\RentType;
@endphp

<form name="formPublicationFilters" id="formPublicationFilters" >
    @csr

    
    <div id="accordion-collapse" data-accordion="collapse" class="mb-3 sticky">
        <h2 id="accordion-collapse-heading-1">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-500 gap-3" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
            <span>{{__('Filtros')}}</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class="grid grid-cols-4 gap-4 items-center p-3">
                <x-form.minimal-input class="mb-3 col-span-1" type="text" id="search" name="search" placeholder="{{__('Buscar')}}"></x-form.minimal-input>

                <div class="flex flex-row mb-3 col-span-1">
                    <x-form.minimal-input class="mr-2 w-1/2" id="price_min" name="price_min" type="text" placeholder="{{__('Precio min.')}}"></x-form.minimal-input>
                    <x-form.minimal-input class="w-1/2" id="price_max" name="price_max" type="text" placeholder="{{__('Precio máx.')}}"></x-form.minimal-input>
                </div>

                <x-form.flowbite-daterangepicker id="dateRangePicker" idDateFrom="available_from" idDateTo="available_to"></x-form.flowbite-daterangepicker>
                

                <x-form.select-input id="rentType" name="rentType" class="mb-3 col-span-1 w-full">
                    <x-form.select-input-option selected>{{__('Tipo de renta')}}</x-form.select-input-option>
                    @foreach (RentType::cases() as $rentType)
                        <x-form.select-input-option value="{{$rentType->name}}">{{$rentType->value}}</x-form.select-input-option>
                    @endforeach
                </x-form.select-input>

                <x-form.select-input id="roomCount" name="roomCount" class="mb-3 col-span-1 w-full">
                    <x-form.select-input-option selected>{{__('Cantidad de habitaciones')}}</x-form.select-input-option>
                    <x-form.select-input-option value="1">1</x-form.select-input-option>
                    <x-form.select-input-option value="1">1</x-form.select-input-option>
                    <x-form.select-input-option value="2">2</x-form.select-input-option>
                    <x-form.select-input-option value="3">3</x-form.select-input-option>
                    <x-form.select-input-option value="4">4</x-form.select-input-option>
                </x-form.select-input>

                <x-form.select-input id="bathroomCount" name="bathroomCount" class="mb-3 col-span-1 w-full">
                    <x-form.select-input-option selected>{{__('Cantidad de baños')}}</x-form.select-input-option>
                    <x-form.select-input-option value="1">1</x-form.select-input-option>
                    <x-form.select-input-option value="2">2</x-form.select-input-option>
                    <x-form.select-input-option value="3">3</x-form.select-input-option>
                    <x-form.select-input-option value="4">4</x-form.select-input-option>
                </x-form.select-input>

                <x-form.select-input id="publication_state" name="publication_state" class="mb-3 col-span-1 w-full">
                    @foreach (PublicationState::cases() as $publication)
                    <x-form.select-input-option placeholder="{{__('Filtrar por')}}" value="{{$publication->name}}">{{__($publication->value)}}</x-form.select-input-option>
                    @endforeach
                </x-form.select-input>

                <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="mb-3 col-span-1 text-right" value="true"></x-form.toggle-switch>
            </div>  
        </div>
    </div>
</form>

