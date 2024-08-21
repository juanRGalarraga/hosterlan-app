
@php
    use App\Enums\Publication\PublicationState;
    use App\Enums\Publication\RentType;
@endphp

<form name="formPublicationFilters" id="formPublicationFilters" >
    @csr
    <x-form.minimal-input label="Buscar"
    class="mb-3" type="text" id="search" name="search"></x-form.minimal-input>

    <x-form.select-input id="publication_state" name="publication_state" label="{{__('Filtar por')}}" class="mb-3 w-full">
        @foreach (PublicationState::cases() as $publication)
        <x-form.select-input-option class="w-full" value="{{$publication->name}}">{{__($publication->value)}}</x-form.select-input-option>
        @endforeach
    </x-form.select-input>

    <x-form.label text="Disponibilidad"></x-form.label>
    <div class="flex flex-row mb-3">
        <x-form.datepicker-input id="available_from" name="available_from" :label="__('Desde')" class="text-white" value=""></x-form.datepicker-input>
        <x-form.datepicker-input id="available_to" name="available_to" :label="__('Hasta')" class="text-white ml-3" value=""></x-form.datepicker-input>
    </div>

    <x-form.label text="Precio"></x-form.label>
    <div class="flex flex-row mb-3">
        <x-form.minimal-input class="w-full" id="price_min" name="price_min" class="mb-3" type="text" placeholder="Min."></x-form.minimal-input>
        <span> a </span>
        <x-form.minimal-input id="price_max" name="price_max" class="mb-3" type="text" placeholder="Máx."></x-form.minimal-input>
    </div>

    <x-form.select-input id="roomCount" name="roomCount" label="{{__('Habitaciones')}}" class="mb-3">
        <x-form.select-input-option value="1">1</x-form.select-input-option>
        <x-form.select-input-option value="2">2</x-form.select-input-option>
        <x-form.select-input-option value="3">3</x-form.select-input-option>
        <x-form.select-input-option value="4">4</x-form.select-input-option>
    </x-form.select-input>

    <x-form.select-input id="bathroomCount" name="bathroomCount" label="{{__('Baños')}}" class="mb-3">
        <x-form.select-input-option value="1">1</x-form.select-input-option>
        <x-form.select-input-option value="2">2</x-form.select-input-option>
        <x-form.select-input-option value="3">3</x-form.select-input-option>
        <x-form.select-input-option value="4">4</x-form.select-input-option>
    </x-form.select-input>

    <x-form.select-input id="rentType" name="rentType" label="{{__('Tipo de renta')}}" class="mb-3">
        @foreach (RentType::cases() as $rentType)
        <x-form.select-input-option value="{{$rentType->name}}">{{$rentType->value}}</x-form.select-input-option>
        @endforeach
    </x-form.select-input>

    <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</form>

