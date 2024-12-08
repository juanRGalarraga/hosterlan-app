@if (isset($emptyBut))
    <div class="w-full flex justify-center mx-auto align-middle mt-10">
        <span class="text-danger">
            <x-utils.not-found-result 
                title="Sin resultados" 
                subtitle="{{$emptyBut}}">
            </x-utils.not-found-result>
        </span>
    </div>
@endif
<div class="p-4 rounded-lg min-h-full">
    <div class="w-full grid sm:grid-cols-1 md:grid-cols-2 gap-x-2 gap-y-14 lg:grid-cols-2 xl:grid-cols-2 xl:gap-x-2 grid-flow-row">
        @foreach($publications as $publication)
            <div class="mx-auto">
                <x-booking-card 
                    class="grid grid-cols-1 bg-blend-darken bg-clip-border text-gray-700 shadow-lg hover:cursor-pointer clickeable-card w-[300px] md:w-[200px] lg:w-[350px] "
                    id="{{ $publication->id }}" 
                    :imageSource="$publication->getFirstPicture()" 
                    :title="__($publication->title)" 
                    :description="__($publication->description)" 
                    :extraInfo="$publication->ubication"
                    footer="Desde {{convert($publication->getMinPrice())}} por noche!"
                    :buttonText="__('')">
                </x-booking-card>
            </div>
        @endforeach
    </div>
</div>