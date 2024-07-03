@php
    use App\Enums\Publication\RentType;
    use App\Enums\Publication\PublicationState;
@endphp

<form id="publicationForm" action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <x-form.label text="Disponibilidad"></x-form.label>
    <div class="flex flex-row mb-3">
        <x-form.datepicker-input id="available_from" name="available_from" :label="__('Desde')" class="text-white" value=""></x-form.datepicker-input>
        <x-form.datepicker-input id="available_to" name="available_to" :label="__('Hasta')" class="text-white ml-2" value=""></x-form.datepicker-input>
    </div>

    <x-form.select-input name="rent_type" id="rentType" label="{{__('Tipo de renta')}}" placeholder="Tipo de renta" class="mb-3">
        @foreach(RentType::cases() as $rentType)
            <x-form.select-input-option value="{{$rentType->name}}">{{$rentType->value}}</x-form.select-input-option>
        @endforeach
    </x-form.select-input>

    <x-form.minimal-input name="room_count" id="roomCount" type="number" label="{{__('Número de habitaciones')}}" class="mb-3"></x-form.minimal-input>

    <x-form.minimal-input name="bath_count" id="bathCount" type="number" label="{{__('Número de baños')}}" class="mb-3"></x-form.minimal-input>

    <x-form.minimal-input name="price" id="monthPrice" type="number" label="{{__('Precio')}}" class="mb-3"></x-form.minimal-input>

    <x-form.minimal-input name="ubication" id="propertyAddress" type="text" label="{{__('Ubicación de la propiedad')}}" class="mb-3"></x-form.minimal-input>

    <div>
        <label for="propertyDescription" class="block text-sm font-medium mb-3 text-gray-300">{{__('Descripción del alquiler')}}</label>
        <textarea name="description" id="propertyDescription" cols="10" rows="3" class="w-full text-gray-900 bg-gray-200 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-white dark:border-gray-600"></textarea>
    </div>
    <x-form.select-input name="pets" id="pets" label="{{__('Se aceptan mascotas')}}" class="mb-3">
        <x-form.select-input-option value="si">Sí</x-form.select-input-option>
        <x-form.select-input-option value="no">No</x-form.select-input-option>
    </x-form.select-input>

    <!-- <input  name="image" id="image" type="file"  multiple="multiple" accept="image/*" label="{{__('Imagen')}}"></input> -->

    <div class="bottom-0 text-center mt-2">
        <button type="submit" class="p-2 rounded-md w-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:bg-blue-700">{{ __('Publicar') }}</button>
    </div>

</form>