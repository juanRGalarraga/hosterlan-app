    @php
    use App\Enums\Publication\RentTypeEnum;

    $optRoomCount = 4;
    $optBathroomCount = 4;
    $optNumberPeople = 10;
    $maxAllowedFiles = env('MAX_ALLOWED_FILES', 5);
    //Storage::disk('local')->put('example.txt', 'Contents');
@endphp

<div class="flex flex-col w-1/2 mx-auto">
    <section class="space-x-2 px-5 my-h-screen pt-3 overflow-y-auto overflow-x-hidden mcss-hover-show-scroll mcss-hide-scroll">
        <form id="publicationForm" name="publicationForm" action="{{ route('publications.create.2') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-form.minimal-input name="title" id="title" autohide="" type="text" value="{{old('title')}}" placeholder="Título de la publicación" class="mt-5 mb-3"></x-form.minimal-input>
            <x-input-error :messages="$errors->first('title')" />
            @if ($errors->has('files'))
                @foreach ($errors->get('files') as $error)
                    <x-alert.warning id="alertWarningMaxAllowedFiles">{{__($error)}}</x-alert.warning>
                @endforeach
            @endif

            @if($errors->first('pictures'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                {{$errors->first('pictures')}}
            </div>
            @endif

            @include('publications.create.form-dropzone')

            <div class="flex overflow-y-hidden overflow-x-auto mcss-hover-show-scroll mcss-hide-scroll space-x-2" id="previewFiles">
            
            </div>

            <div id="available_days" class="w-fit my-4 mx-auto grid grid-cols-2 xl:grid-cols-4 gap-x-2 gap-y-1"></div>
        
            <x-form.select-input name="rent_type_id" id="rent_type_id" value="{{old('rent_type_id')}}" label="{{__('Tipo de renta')}}" placeholder="Tipo de renta" class="mb-3 w-full">
                @foreach(RentTypeEnum::cases() as $key => $rentType)
                    <x-form.select-input-option value="{{$key}}">{{$rentType->value}}</x-form.select-input-option>
                @endforeach
            </x-form.select-input>
        
            <x-form.select-input id="bathroom_count" value="{{old('bathroom_count')}}" name="bathroom_count" label="{{__('Baños')}}" class="mb-3 w-full">
                @for ($i=1;$i<=$optBathroomCount;$i++)
                    <x-form.select-input-option value="{{$i}}">{{$i}}</x-form.select-input-option>
                @endfor
            </x-form.select-input>

            <x-form.select-input id="number_people" value="{{old('number_people')}}" name="number_people" label="{{__('Máx. personas')}}" class="mb-3 w-full">
                @for ($i=1;$i<=$optNumberPeople;$i++)
                    <x-form.select-input-option value="{{$i}}">{{$i}}</x-form.select-input-option>
                @endfor
            </x-form.select-input>
        
            <x-form.minimal-input name="price" id="price" value="{{old('price')}}" type="text" label="{{__('Precio por noche')}}" class="mb-3"></x-form.minimal-input>
            <x-input-error :messages="$errors->first('price')" />

            <x-form.minimal-input name="ubication" id="ubication" value="{{old('ubication')}}" type="text" label="{{__('Ubicación de la propiedad')}}" class="mb-3"></x-form.minimal-input>
            <x-input-error :messages="$errors->first('ubication')" />

            <div class="my-4">
                <label for="description" class="block text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{__('Descripción del alquiler...')}}">{{old('description')}}</textarea>
            </div>
            <x-input-error :messages="$errors->first('description')" />
        
            <x-form.toggle-switch label="{{__('Permite mascotas')}}"  name="pets" id="pets" class="withPets mb-[10-rem]" value="{{old('pets', 0)}}"></x-form.toggle-switch>
        
        </form>
    </section>
    <div class="bottom-0 relative text-center justify-center mx-0 mb-6">
        <button form="publicationForm" type="submit" class="p-2 rounded-md w-full text-white border-2 border-blue-700 hover:bg-blue-700 focus:bg-blue-700">{{ __('Siguiente') }}</button>
    </div>
</div>
