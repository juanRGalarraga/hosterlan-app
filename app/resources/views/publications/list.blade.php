@forelse($publications as $publication)
    <div>
        <x-booking-card class="hover:cursor-pointer clickeable-card" :imageSource="$publication->getFirstPicture()" :title="__($publication->title)" :description="__($publication->description)" :buttonText="__('')"></x-booking-card>
    </div>
@empty
    <span class="text-danger">
        <strong>{{__('No se encontraron publicaciones')}}</strong>
    </span>
@endforelse