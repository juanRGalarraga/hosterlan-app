
@php
    use App\Enums\Publication\AvailableDayEnum;
    use App\Enums\Publication\RentTypeEnum;
    use App\Models\RentType;
@endphp

<form name="formPublicationFilters" id="formPublicationFilters" >
    @csrf
    <div class="w-full text-center">
        <x-primary-button class="mb-3" type="button" id="buttonApplyFilter">{{__('Aplicar')}}</x-primary-button>
        <x-secondary-button class="mb-3" type="button" id="buttonClearFilter">{{__('Borrar')}}</x-primary-button>
    </div>

    <div class="flex flex-row mb-3 col-span-1">
        <x-form.minimal-input class="mr-2 w-1/2" id="price_min" name="price_min" type="text" placeholder="{{__('Precio min.')}}"></x-form.minimal-input>
        <x-form.minimal-input class="w-1/2" id="price_max" name="price_max" type="text" placeholder="{{__('Precio máx.')}}"></x-form.minimal-input>
    </div>

    <x-form.date-range-picker id="dateRangePicker" idDateFrom="available_since" idDateTo="available_to"></x-form.flowbite-daterangepicker>
    
    <x-form.select-input id="rentType" name="rentType" class="mb-3 col-span-1 w-full">
        <x-form.select-input-option selected>{{__('Tipo de renta')}}</x-form.select-input-option>
        @foreach (RentType::all(['id', 'name']) as $rentType)
            <x-form.select-input-option value="{{$rentType->id}}">{{$rentType->name}}</x-form.select-input-option>
        @endforeach
    </x-form.select-input>

    <x-form.select-input id="roomCount" name="roomCount" class="mb-3 col-span-1 w-full">
        <x-form.select-input-option selected>{{__('Cantidad de habitaciones')}}</x-form.select-input-option>
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
        <x-form.select-input-option selected value="">{{__('Estado')}}</x-form.select-input-option>
        @foreach (AvailableDayEnum::cases() as $publication)
        <x-form.select-input-option placeholder="{{__('Filtrar por')}}" value="{{$publication->name}}">{{__($publication->value)}}</x-form.select-input-option>
        @endforeach
    </x-form.select-input>

    <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="mb-3 col-span-1 text-right" value="false"></x-form.toggle-switch>
</form>

