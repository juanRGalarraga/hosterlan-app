@php
    $publication = $reservation->availableDay->publication;
@endphp
<x-app-layout>
    <div class="form-container p-40 grid-cols-200 px-auto">
        <h1 class="text-2xl font-bold form-title mb-6 dark:text-white">Detalles de la Reserva</h1>

        <div class="col-span-2 md:col-span-2 ml-3 col-start-3">

            <x-publication.mini-card
                srcImage="{{$publication->getFirstPicture()}}"
                title="{{$publication->title}}"
                subtitle="{{$publication->rentType->name}}"
            ></x-publication.mini-card>

            <h2 class="text-2xl font-bold form-title mb-6 dark:text-white">{{__('Detalles del precio')}}</h2>
            <div class="flex justify-between">
                <span class="dark:text-white">{{convert($publication->price)}} por {{$reservation->availableDay->dayCount()}} noches</span>
                <span class="dark:text-white">{{convert($reservation->availableDay->finalPrice())}}</span>
            </div>
        </div>
    </div>
</x-app-layout>