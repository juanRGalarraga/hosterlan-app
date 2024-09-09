@php
  use App\Enums\Publication\AvailableDayEnum;
  $currencyFormat = env('CURRENCY_FORMAT', '$');
@endphp

<x-app-layout :includeNav="false">
  
  <x-slot:scripts>
        @vite([
            'resources/js/publications/show/main.js',
            'resources/css/publications/show/show.css',
        ])
  </x-slot:scripts>


<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>
<button type="button" id="buttonCloseView" class="absolute top-4 right-4 bg-gray-700 text-white rounded-full p-2 focus:outline-none z-50">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
  </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-[30%] xl:w-1/4 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto mcss-hide-scroll css-hover-show-scroll  bg-gray-50 dark:bg-gray-800">
      <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
         <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3 sm:h-7" alt="Flowbite Logo" />
         <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{$publication->user->name}}</span>
      </a>
      <p class="text-sm text-center font-light dark:text-white">{{__('Publicado el ')}} {{$publication->getFormattedCreatedAt()}}</p>
      <!-- Título -->
      <h1 class="text-2xl font-bold mb-4 text-center dark:text-white">{{$publication->title}}</h1>
      
      <!-- Precio -->
      <div class="text-xl text-green-400 font-semibold mb-4 text-center">{{$currencyFormat}}@convert($publication->price)</div>

      <!-- Grupo de botones -->
      <div class="justify-center flex">
      <div class="inline-flex rounded-md shadow-sm justify-center" role="group">
        <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
          </svg>
          {{__('Mensaje')}}
        </button>
        <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
          </svg>
          {{__('Compartir')}}
        </button>
        <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
          </svg>
          {{__('Guardar')}}
        </button>
      </div>
      </div>


      <!-- Descripción -->
      <div class="text-gray-300 rounded-lg bg-gray-500 p-5 mt-3">
        <p id="textDescriptionContent">
          {{$publication->description}}
        </p>
      </div>
        
      <hr class="my-3">

      <p class="text-sm text-center mb-3 dark:text-white">{{__('Días disponibles')}}</p>
      
    <div class="w-full text-center text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @foreach ($publication->daysAvailable as $dayAvailable)
              @php 
                //$canReserve = $dayAvailable->
              @endphp

              <button type="button"
                data-day-available-id={{$dayAvailable->id}} 
                data-date="{{$dayAvailable->since . " hasta " . $dayAvailable->to}}"
                data-modal-target="reserveDayModal"
                data-modal-show="reserveDayModal"
                  @class([
                      'buttons-reserve-day',
                      'cursor-not-allowed' => !$dayAvailable->isAvailable(),
                      'relative',
                      'inline-flex',
                      'items-center',
                      'w-full',
                      'px-4',
                      'py-2',
                      'text-sm',
                      'font-medium',
                      'border-b',
                      'border-gray-200',
                      'rounded-t-lg',
                      'hover:bg-gray-100' => $dayAvailable->isAvailable(),
                      'hover:text-blue-700'  => $dayAvailable->isAvailable(),
                      'focus:z-10 focus:ring-2'  => $dayAvailable->isAvailable(),
                      'focus:ring-blue-700'  => $dayAvailable->isAvailable(),
                      'focus:text-blue-700'  => $dayAvailable->isAvailable(),
                      'dark:border-gray-600',
                      'dark:hover:text-gray-500' => $dayAvailable->isAvailable(),
                      'dark:focus:text-white'  => $dayAvailable->isAvailable(),
                      'dark:focus:ring-gray-500'  => $dayAvailable->isAvailable(),
                      'cursor-pointer'  => $dayAvailable->isAvailable(),
                      'text-gray-500' => !$dayAvailable->isAvailable(),
                  ])
                  @disabled(!$dayAvailable->isAvailable())
                  type="button">

                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                  </svg>
                  {{$dayAvailable->since . " " . __('hasta el') . " " . $dayAvailable->to}}
              </button>
        @endforeach
    </div>
  </div>
</aside>

<div class="w-full">
  @include('publications.show.carrousel')
</div>

<div>
    @include('publications.show.reserve-day-modal')
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
