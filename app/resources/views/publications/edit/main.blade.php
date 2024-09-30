<x-app-layout :includeSearchNav="false">

    <x-slot:scripts>
        @vite([
            'resources/js/publications/edit/main.js',
            'resources/css/main.css',
        ])
    </x-slot:scripts>

    <x-slot:header>
        {{__('Mis propiedades')}}
    </x-slot:header>

    <div class="flex flex-row mcss-max-h-screen mcss-h-screen justify-center">
        <div class="bg-gray-900 flex justify-center py-10">
            <table class="min-w-full bg-gray-800 text-white  p-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-700">Numero</th>
                        <th class="py-2 px-4 border-b border-gray-700">Titulo</th>
                        <th class="py-2 px-4 border-b border-gray-700">Descripcion</th>
                        <th class="py-2 px-4 border-b border-gray-700">Precio</th>
                        <th class="py-2 px-4 border-b border-gray-700">Fecha de alta</th>
                        <th class="py-2 px-4 border-b border-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody id="mainList">
                    
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>