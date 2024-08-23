<div class="max-w-full overflow-x-auto py-4">
  <div class="flex space-x-4 px-2">
    <div class="min-w-[120px] h-[150px] bg-gray-200 rounded-md shadow-md flex items-center justify-center relative">
        @if( !empty($filenames) && !empty($src))
            @for ($i=0; $i < count($filenames); $i++)
            <x-form.file-preview deleteAction="" :filename="$filenames[$i]" previewSrc="{{$src[$i]}}" imgClassName="w-[400px] h-[70px]" class="imagesPreview  text-justify"></x-form.file-preview>
            @endfor
        @endif
    </div>
  </div>
</div>