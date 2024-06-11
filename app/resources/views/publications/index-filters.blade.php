<!-- <div class="w-fit hover:cursor-pointer show-scroll"> -->
    <div class="w-64 pl-4 overflow-y-auto fixed-filters-zone show-scroll">
        <!-- Filtro de Búsqueda -->
        <x-form.minimal-input label="Buscar" 
        class="mb-3" type="text" id="buscador"></x-form.minimal-input>

        <x-form.select-input id="" label="{{__('Ordenar por')}}" class="mb-3">
            <x-form.select-input-option value="Opcion1">Opcion1</x-form.select-input-option>
            <x-form.select-input-option value="Opcion2">Opcion2</x-form.select-input-option>
            <x-form.select-input-option value="Opcion3">Opcion3</x-form.select-input-option>
            <x-form.select-input-option value="Etc">Etc</x-form.select-input-option>
        </x-form.select-input>

        <x-form.label text="Disponibilidad"></x-form.label>
        <div class="flex flex-row mb-3">
            <x-form.datepicker-input :label="__('Desde')" class="text-white"></x-form.datepicker-input>
            <x-form.datepicker-input :label="__('Hasta')" class="text-white ml-2"></x-form.datepicker-input>
        </div>

        <x-form.label text="Precio"></x-form.label>
        <div class="flex flex-row mb-3">
            <x-form.minimal-input class="mb-3" type="text" id="" placeholder="Min."></x-form.minimal-input>
            <span>a</span>
            <x-form.minimal-input class="mb-3" type="text" id="" placeholder="Máx."></x-form.minimal-input>
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
            <x-form.minimal-input class="mb-3" type="text" id="" placeholder="Min."></x-form.minimal-input>
            <span>a</span>
            <x-form.minimal-input class="mb-3" type="text" id="" placeholder="Máx."></x-form.minimal-input>
        </div>

        <x-form.toggle-switch label="Permite mascotas"></x-form.toggle-switch>
    </div>


    <div class="flex-1 overflow-y-auto pl-4 ml-64" style="max-height: calc(100vh - 60px);">
        <div class="gallery grid grid-cols-3 gap-4">
        </div>
    </div>
<!-- </div> -->

