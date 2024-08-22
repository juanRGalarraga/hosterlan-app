<x-app-layout :includeNav="false">
  
  <x-slot:scripts>
        @vite(['resources/js/publication/show/show.js'])
  </x-slot:scripts>

  @push('custom-css')
    <link rel="stylesheet" href="/css/publications/show.css?v={{time()}}"/>
  @endpush

  @php
    $currencyFormat = env('CURRENCY_FORMAT', '$');
  @endphp

<div class="bg-gray-900 text-white flex flex-col lg:flex-row h-screen w-full relative">
  <!-- Botón de cierre -->
  <button type="button" id="buttonCloseView" class="absolute top-4 right-4 bg-gray-700 text-white rounded-full p-2 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>

  @include('publications.show-carrousel')

  <!-- Lado derecho más pequeño con scroll independiente -->
  <div class="lg:w-1/4 w-full h-full bg-gray-700 p-4 flex flex-col justify-start overflow-y-auto scrollbar-hide">
    <!-- Título -->
    <h1 class="text-2xl font-bold mb-4">{{$publication->title}}</h1>
    <h6>{{$publication->getFormattedUpdateAt()}}</h6>
    
    <!-- Precio -->
    <div class="text-xl text-green-400 font-semibold mb-4">{{$currencyFormat}}@convert($publication->price)</div>

    <!-- Grupo de botones -->
    <div class="flex space-x-2 mb-4">
      <button class="bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
        </svg>
      </button>
      <button class="bg-yellow-600 text-white px-4 py-2 rounded focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
      </button>
      <button class="bg-gray-600 text-white px-4 py-2 rounded focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    <!-- Descripción -->
    <div class="text-gray-300">
      <p>
        {{$publication->description}}
      </p>
    </div>
  </div>
</div>




</x-app-layout>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        width: 0 !important;
        height: 0 !important;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide:hover::-webkit-scrollbar {
        width: 6px !important;
        height: 6px !important;
    }
</style>
