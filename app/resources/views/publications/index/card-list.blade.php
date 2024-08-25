@foreach($publications as $publication)

    <div class="mx-auto">
        <x-booking-card id="{{$publication->id}}" class="hover:cursor-pointer clickeable-card w-[300px]  md:w-[200px] lg:w-[350px]" :imageSource="$publication->getFirstPicture()" :title="__($publication->title)" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
    </div>    
@endforeach