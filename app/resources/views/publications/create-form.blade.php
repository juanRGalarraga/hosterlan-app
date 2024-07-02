<form id="publicationForm" action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
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

    <!-- <input  name="image" id="image" type="file"  multiple="multiple" accept="image/*" label="{{__('Imagen')}}"></input> -->

    <div class="bottom-0 text-center mt-2">
        <button type="submit" class="p-2 rounded-md w-full text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:bg-blue-700">{{ __('Publicar') }}</button>
    </div>

</form>