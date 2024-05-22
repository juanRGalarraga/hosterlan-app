<x-app-layout>
    <div>
    @forelse ($publications as $publication)
        <x-booking-card :title="__($publication->title??'Title')" :description="__($publication->description)"></x-booking-card>
    @empty
        <span class="text-danger">
            <strong>{{__('No se encontraron publicaciones')}}</strong>
        </span>
    @endforelse
    </div>

    {{$publications->links()}}

</x-app-layout>