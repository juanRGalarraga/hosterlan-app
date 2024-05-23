<x-app-layout>

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <div class="flex">
        <div class="w-[20%] pl-3 mt-3">
            <x-form.minimal-input class="mb-3" type="text" id="buscador" placeholder="Buscar" labelIcon="a"></x-form.minimal-input>
            <x-form.minimal-input class="mb-3" type="text" id="buscador" placeholder="Buscar"></x-form.minimal-input>
        </div>
        <div class="w-[80%] flex flex-wrap justify-center mt-3">
            @forelse($publications as $publication)
                <div>
                    <x-booking-card class="ml-3" :title="__($publication->title??'Title')" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
                </div>
            @empty
                <span class="text-danger">
                    <strong>{{__('No se encontraron publicaciones')}}</strong>
                </span>
            @endforelse
        </div>
    </div>
    <div class="text-center justify-center flex flex-shrink-2">
        {{$publications->links()}}
    </div>

</x-app-layout>