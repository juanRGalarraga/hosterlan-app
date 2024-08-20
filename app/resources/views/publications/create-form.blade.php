    @php
    use App\Enums\Publication\RentType;

    $optRoomCount = 4;
    $optBathroomCount = 4;
    $optNumberPeople = 10;
    //Storage::disk('local')->put('example.txt', 'Contents');
@endphp

<div class="flex flex-col w-1/5 md:w-2/5 lg:w-1/5" id="description">
    <section class="space-x-2 overflow-y-auto overflow-x-hidden show-scroll fixed-filters-zone px-5 my-h-screen pt-3">
        <form id="publicationForm" name="publicationForm" action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3 class="text-white font-bold text-lg mb-3">{{__('Nueva publicación')}}</h3>

            @include('publications.create-form-dropzone')
            <x-input-error :messages="$errors->images->first('image')" />

            <x-form.minimal-input name="title" id="title" type="text" value="{{old('title')}}" placeholder="Título de la publicación" class="mb-3"></x-form.minimal-input>
            <x-input-error :messages="$errors->first('title')" />

            <x-form.label text="Disponibilidad"></x-form.label>
            <div class="flex flex-row mb-3">
                <x-form.datepicker-input id="available_from" value="{{old('available_from')}}" name="available_from" :label="__('Desde')" class="text-white" value=""></x-form.datepicker-input>
                <x-form.datepicker-input id="available_to" value="{{old('available_to')}}" name="available_to" :label="__('Hasta')" class="text-white ml-[2px]" value=""></x-form.datepicker-input>
            </div>
        
            <x-form.select-input name="rent_type_id" id="rent_type_id" value="{{old('rent_type_id')}}" label="{{__('Tipo de renta')}}" placeholder="Tipo de renta" class="mb-3">
                @foreach(RentType::cases() as $key => $rentType)
                    <x-form.select-input-option value="{{$key}}">{{$rentType->value}}</x-form.select-input-option>
                @endforeach
            </x-form.select-input>
        
            <x-form.select-input id="room_count" value="{{old('room_count')}}" name="room_count" label="{{__('Habitaciones')}}" class="mb-3">
                @for ($i=1;$i<=$optRoomCount;$i++)
                    <x-form.select-input-option value="{{$i}}">{{$i}}</x-form.select-input-option>
                @endfor
            </x-form.select-input>
        
            <x-form.select-input id="bathroom_count" value="{{old('bathroom_count')}}" name="bathroom_count" label="{{__('Baños')}}" class="mb-3">
                @for ($i=1;$i<=$optBathroomCount;$i++)
                    <x-form.select-input-option value="{{$i}}">{{$i}}</x-form.select-input-option>
                @endfor
            </x-form.select-input>

            <x-form.select-input id="number_people" value="{{old('number_people')}}" name="number_people" label="{{__('Máx. personas')}}" class="mb-3">
                @for ($i=1;$i<=$optNumberPeople;$i++)
                    <x-form.select-input-option value="{{$i}}">{{$i}}</x-form.select-input-option>
                @endfor
            </x-form.select-input>
        
            <x-form.minimal-input name="price" id="price" value="{{old('price')}}" type="text" label="{{__('Precio por noche')}}" class="mb-3"></x-form.minimal-input>
            <x-input-error :messages="$errors->first('price')" />

            <x-form.minimal-input name="ubication" id="ubication" value="{{old('ubication')}}" type="text" label="{{__('Ubicación de la propiedad')}}" class="mb-3"></x-form.minimal-input>
            <x-input-error :messages="$errors->first('ubication')" />

            <div>
                <label for="description" class="block text-sm font-medium mb-3 text-gray-300">{{__('Descripción del alquiler')}}</label>
                <textarea name="description" id="description" cols="10" rows="3" class="w-full text-gray-900 bg-gray-200 border border-gray-300 rounded-md dark:bg-gray-600 dark:text-white dark:border-gray-600">{{old('description')}}</textarea>
            </div>
            <x-input-error :messages="$errors->first('description')" />
        
            <x-form.toggle-switch label="{{__('Permite mascotas')}}"  name="pets" id="pets" class="withPets mb-[10-rem]" value="{{old('pets', 0)}}"></x-form.toggle-switch>
            
            <!-- <input  name="image" id="image" type="file"  multiple="multiple" accept="image/*" label="{{__('Imagen')}}"></input> -->
    
        </form>
    </section>
    <div class="bottom-0 relative text-center justify-center mx-0 mb-6">
        <button form="publicationForm" type="submit" class="p-2 rounded-md w-full text-white border-2 border-blue-700 hover:bg-blue-700 focus:bg-blue-700">{{ __('Publicar') }}</button>
    </div>
</div>
