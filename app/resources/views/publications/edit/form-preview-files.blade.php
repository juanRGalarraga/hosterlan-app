@if(is_array($files) && count($files) >= 1 )
    @foreach ($files as $filename => $data)
        <input type="hidden" name="currentFiles[]" value="{{$data}}">
        <x-form.file-preview 
            :filename="$filename"
            :previewSrc="$data"
            imgClassName="w-[100px] h-[70px]"
            class="imagesPreview min-w-max mb-2">
        </x-form.file-preview>
    @endforeach
@endif