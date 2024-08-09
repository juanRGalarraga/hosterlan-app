@php
    use App\Enums\Publication\RentType;
@endphp

<div class="flex flex-col" id="description">
    <section class="space-x-2 overflow-y-auto overflow-x-hidden show-scroll fixed-filters-zone px-5 ">
        <form id="publicationForm" action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form.label text="Disponibilidad"></x-form.label>
            <div class="flex flex-row mb-3">
                <x-form.datepicker-input id="available_from" name="available_from" :label="__('Desde')" class="text-white" value=""></x-form.datepicker-input>
                <x-form.datepicker-input id="available_to" name="available_to" :label="__('Hasta')" class="text-white ml-[2px]" value=""></x-form.datepicker-input>
            </div>
        
            <x-form.select-input name="rent_type" id="rentType" label="{{__('Tipo de renta')}}" placeholder="Tipo de renta" class="mb-3">
                @foreach(RentType::cases() as $rentType)
                    <x-form.select-input-option value="{{$rentType->name}}">{{$rentType->value}}</x-form.select-input-option>
                @endforeach
            </x-form.select-input>
        
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
        
            <x-form.minimal-input name="price" id="price" type="number" label="{{__('Precio por noche')}}" class="mb-3"></x-form.minimal-input>
        
            <x-form.minimal-input name="address" id="address" type="text" label="{{__('Ubicación de la propiedad')}}" class="mb-3"></x-form.minimal-input>
        
            <div>
                <label for="propertyDescription" class="block text-sm font-medium mb-3 text-gray-300">{{__('Descripción del alquiler')}}</label>
                <textarea name="description" id="propertyDescription" cols="10" rows="3" class="w-full text-gray-900 bg-gray-200 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-white dark:border-gray-600"></textarea>
            </div>
        
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            <x-form.toggle-switch label="{{__('Permite mascotas')}}" name="withPets" id="withPets" class="withPets mb-[10-rem]" value="true"></x-form.toggle-switch>
            
            <!-- <input  name="image" id="image" type="file"  multiple="multiple" accept="image/*" label="{{__('Imagen')}}"></input> -->
    
        </form>
    </section>
    <div class="bottom-0 relative text-center justify-center mx-0">
        <button form="publicationForm" type="submit" class="p-2 rounded-md w-full text-white border-2 border-blue-700 hover:bg-blue-700 focus:bg-blue-700">{{ __('Publicar') }}</button>
    </div>
</div>
