<x-guest-layout>
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
        <!-- Parte superior -->
        <div class="mb-6">
            <h2 class="font-semibold text-center text-white text-md">{{__('¿Busca publicar alquileres?')}}</h2>
            <a href="{{route('register', 'owner')}}">
                <div class="flex items-center justify-around mt-4 p-4 border-dashed border-2 border-gray-600 rounded-lg cursor-pointer hover:bg-gray-700">
                    <div class="mr-4">
                        <!-- Placeholder para ícono -->
                        <div class="bg-gray-600 w-16 h-16 rounded-lg flex items-center justify-center">
                            <!-- Reemplaza esto con el ícono real -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>

                        </div>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-white">{{__('Cuenta de propietario')}}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Línea divisoria -->
        <div class="border-t border-gray-600 my-4"></div>

        <!-- Parte inferior -->
        <div>
            <h2 class="text-md font-semibold text-center text-white">{{__('¿Busca alquileres en tu zona?')}}</h2>
            <a href="{{route('register', 'guest')}}">
                <div class="flex items-center justify-around mt-4 p-4 border-dashed border-2 border-gray-600 rounded-lg cursor-pointer hover:bg-gray-700">
                    <div class="mr-4">
                        <!-- Placeholder para ícono -->
                        <div class="bg-gray-600 w-16 h-16 rounded-lg flex items-center justify-center">
                            <!-- Reemplaza esto con el ícono real -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-lg font-medium text-white">{{__('Cuenta de huesped')}}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-guest-layout>