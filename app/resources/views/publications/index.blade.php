<x-app-layout>

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <div class="flex flex-wrap justify-end">
    @forelse ($publications as $publication)
        <x-booking-card class="ml-3" :title="__($publication->title??'Title')" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
    @empty
        <span class="text-danger">
            <strong>{{__('No se encontraron publicaciones')}}</strong>
        </span>
    @endforelse
    </div>
    <div class="text-center justify-center flex flex-shrink-2">
        {{$publications->links()}}
    </div>


</x-app-layout>