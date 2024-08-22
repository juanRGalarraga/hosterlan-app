<x-app-layout>
    @push('custom-css')
        <link  rel="stylesheet" type="text/css" href="/css/publications/index.css">
    @endpush

    <x-slot:scripts>
        @vite(['resources/js/publication/index/filters.js'])
    </x-slot:scripts>

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>

    <button type="button" class="z-20 fixed inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="drawer-navigation" aria-expanded="false" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation">
      <span class="sr-only">{{__('Filtros')}}</span>
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
        </svg>
    </button>

    <!-- drawer component -->
    <div id="drawer-navigation" class="mt-20 fixed top-0 left-0 z-40 w-70 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
        <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">{{__('Filtros')}}</h5>
        <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="py-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                @include('publications.index-filters')
            </ul>
        </div>
    </div>
    <div class="pl-3 mt-3 w-full relative">
        <div class="w-full grid sm:grid-cols-1 md:grid-cols-2 gap-x-2 lg:grid-cols-3 xl:grid-cols-4 grid-flow-row" id="publicationMainlist">
            @include('publications.list')
        </div>
    </div>
    <div class="text-center flex justify-center w-full">
        {{$publications->links()}}
    </div>
</x-app-layout>