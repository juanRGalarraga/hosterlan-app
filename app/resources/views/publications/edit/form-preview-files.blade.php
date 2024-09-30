@php
    //dump($files)
@endphp
@if(is_array($files) && count($files) >= 1 )
    @foreach ($files as $id => $data)
        <input type="hidden" id="{{$id}}" class="files" value="{{$data}}">
        <x-form.file-preview 
        :filename="$id"
        :previewSrc="$data"
        imgClassName="w-[100px] h-[70px]"
        class="imagesPreview min-w-max mb-2">
        </x-form.file-preview>
    @endforeach
    @csrf
@endif