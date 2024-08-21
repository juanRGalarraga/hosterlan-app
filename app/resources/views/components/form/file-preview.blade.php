<span {{$attributes->merge(['class' => 'z-[1] relative text-white font-bold bg-slate-500 rounded-md py-5 px-2 mb-2 text-center flex flex-col justify-center align-middle'])}} title="{{$filename}}">
    <button class="z-[3] absolute right-2 top-2 hover:bg-red-400" title="{{__('Borrar imagen')}}" data-filename="{{$filename}}" type="button" data-button-delete-preview-file>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="z-[2] size-6" >
            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
    </button>
    @if(!empty($previewSrc))
        <img src="{{$previewSrc}}" class="{{$imgClassName}}">
    @endif
    {{ elipsis($filename, 7) }}
</span>