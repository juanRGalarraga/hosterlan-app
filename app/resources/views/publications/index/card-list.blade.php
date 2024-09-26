@php

@endphp
@if($publications->count() >= 1)
<div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 min-h-full">
    <div class="w-full grid sm:grid-cols-1 md:grid-cols-2 gap-x-2 gap-y-32 lg:grid-cols-2 xl:grid-cols-4 grid-flow-row">
        @foreach($publications as $publication)
            <div class="mx-auto">
                <x-booking-card id="{{$publication->id}}" class="hover:cursor-pointer clickeable-card w-[300px]  md:w-[200px] lg:w-[350px] min-h-fit" :imageSource="$publication->getFirstPicture()" :title="__($publication->title)" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
            </div>
        @endforeach
    </div>
</div>
@else
<div class="w-full flex justify-center mx-auto align-middle mt-10">
    <span class="text-danger">
        <x-utils.not-found-result title="No se encontraron resultados" subtitle="Intenta ajustar tus filtros o busca con términos diferentes."></x-utils.not-found-result>
    </span>
</div>
@endif