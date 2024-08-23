@if( !empty($filenames) && !empty($src))
    @for ($i=0; $i < count($filenames); $i++)
        <x-form.file-preview deleteAction="" filename="{{$filenames[$i]}}" previewSrc="{{$src[$i]}}" imgClassName="w-[70px] h-[70px]" class="mr-4"></x-form.file-preview>
    @endfor
@endif