@php
    $imageSourceDefault = 'https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1470&amp;q=80';
    $defaultClasses = "relative flex flex-col bg-blend-darken bg-clip-border text-gray-700 shadow-lg";
@endphp

@props(['imageSource' => $imageSourceDefault, 'title', 'description', 'buttonText' ,'rating' => '', 'footer' => '', 'extraInfo' => ''])

<div {{$attributes->merge(['class' => $defaultClasses])}}>
  <div class="col-span-1 relative overflow-hidden bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40">
    <div style="background-image: url('{{$imageSource}}');" class="bg-no-repeat bg-cover bg-center rounded-md h-[9rem] to-bg-black-10 inset-0 from-transparent via-transparent to-black/60"></div>
  </div>
  <div class="col-span-1 p-3">
      <div class="block font-sans text-xs font-light leading-relaxed text-white antialiased max-h-fit">
        {{$description}}
      </div>
      <div class="font-mono font-extralight text-xs italic leading-relaxed text-white antialiased flex flex-row justify-between">
        {{$extraInfo}}
      </div>
      <footer class="font-mono font-extralight text-xs italic leading-relaxed text-green-400 antialiased flex flex-row justify-between">
        {{$footer}}
      </footer>
  </div>
</div>