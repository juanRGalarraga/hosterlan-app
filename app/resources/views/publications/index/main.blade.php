<x-app-layout>
    <x-slot:scripts>
        @vite([
            'resources/js/publications/index/filters.js',
            'resources/css/publications/index/index.css'
        ])
    </x-slot:scripts>

    <x-slot:header>
        {{__('Propiedades disponibles')}}
    </x-slot:header>
    
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="mt-32 fixed top-0 left-0 z-40 w-80 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <h5 id="drawer-navigation-label" class="text-base text-center my-3 font-semibold text-gray-500 uppercase dark:text-gray-400">{{__('Filtros')}}</h5>
            <ul class="space-y-2 font-medium">
                <li>
                    @include('publications.index.filters')
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-72 mt-10 min-h-screen">
        @if($publications->count() >= 1)
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 min-h-full">
            <div class="w-full grid sm:grid-cols-1 md:grid-cols-2 gap-x-2 lg:grid-cols-3 xl:grid-cols-4 grid-flow-row" id="publicationMainlist">
                @include('publications.index.card-list')
            </div>
        </div>
        @else
        <div class="w-full flex justify-center m-auto align-middle mt-10">
            <span class="text-danger w-full">
                <x-utils.not-found-result title="No se encontraron resultados" subtitle="Intenta ajustar tus filtros o busca con términos diferentes."></x-utils.not-found-result>
            </span>
        </div>
        @endif
        <div class="text-center flex justify-center w-full mt-2">
            {{$publications->links()}}
        </div>

    </div>
</x-app-layout>