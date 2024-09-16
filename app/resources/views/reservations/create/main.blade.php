@php
    $publication = $reservation->publicationDayAvailable->publication;
@endphp
<x-app-layout>
    <div class="form-container p-52 grid grid-cols-4 px-auto">
        <div class="col-span-2 col-start-1">
            <h2 class="text-2xl font-bold form-title mb-6">{{__('Confirmación de Reserva')}}</h2>
            <form action="{{route('reservations.store', $reservation->id)}}" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300">{{__('Nombre Completo')}}</label>
                    <input type="text" id="name" name="name" value="{{Auth::user()->name ." ". Auth::user()->surname}}" required class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white">
                </div>
    
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">{{__('Correo Electrónico')}}</label>
                    <input type="email" id="email" name="email" value="{{Auth::user()->email}}" required class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white">
                </div>

                <div class="mb-4">
                    <label for="phoneNumber" class="block text-sm font-medium text-gray-300">{{__('Teléfono de contacto')}}</label>
                    <input type="number" id="phoneNumber" name="phoneNumber" required class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white">
                </div>

                <div class="flex flex-row w-full">
                    <div class="mb-4 w-full">
                        <label for="since" class="block text-sm font-medium text-gray-300">{{__('Fecha de Llegada')}}</label>
                        <input type="text" id="since" name="since" value="{{$reservation->publicationDayAvailable->since}}"  readonly class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white cursor-not-allowed">
                    </div>
        
                    <div class="mb-4 w-full">
                        <label for="to" class="block text-sm font-medium text-gray-300">{{__('Fecha de Salida')}}</label>
                        <input type="text" id="to" name="to" value="{{$reservation->publicationDayAvailable->to}}" readonly class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white cursor-not-allowed">
                    </div>
                </div>
    
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-300">{{__('Mensaje Adicional')}}</label>
                    <textarea id="message" name="message" rows="4" maxlength="200" placeholder="{{__('Max. 200 caract.')}}" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white"></textarea>
                </div>
    
                <div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        {{__('Confirmar Reserva')}}
                    </button>
                </div>
            </form>
        </div>

        
        <div class="col-span-1 ml-3 col-start-3">

            <div class=" bg-gray-800 text-white rounded-lg shadow-md overflow-hidden mb-3 w-full mx-auto">
                <!-- Imagen -->
                <div class="relative">
                    <img class="w-full h-48 object-cover" src="{{$publication->getFirstPicture()}}" alt="La Carmelita">
                </div>
    
                <!-- Contenido -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold">{{$publication->title}}</h3>
                    <p class="text-sm text-gray-400 mt-2">{{$publication->rentType->name}}</p>
                    
                    <!-- Calificación -->
                    <!-- <div class="flex items-center mt-3">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049 2.927C9.469 1.637 10.531 1.637 10.951 2.927L12.3 6.818C12.449 7.232 12.846 7.5 13.293 7.5H17.292C18.592 7.5 19.057 8.971 18.097 9.742L14.688 12.442C14.318 12.726 14.156 13.219 14.287 13.684L15.361 17.553C15.742 18.864 14.468 19.924 13.401 19.191L10.1 17.07C9.686 16.79 9.148 16.79 8.735 17.07L5.434 19.191C4.366 19.924 3.093 18.864 3.474 17.553L4.548 13.684C4.679 13.219 4.517 12.726 4.147 12.442L0.738 9.742C-0.222 8.971 0.243 7.5 1.543 7.5H5.542C5.989 7.5 6.386 7.232 6.535 6.818L7.884 2.927Z" />
                    </svg>
                    <span class="text-sm ml-2">4.96 (28 evaluaciones)</span>
                    </div> -->
                </div>
            </div>

            <h2 class="text-2xl font-bold form-title mb-6">Detalles del precio</h2>
            <div class="flex justify-between">
                <span>@convert($publication->price) por {{$reservation->publicationDayAvailable->dayCount()}} noches</span>
                <span>@convert($reservation->publicationDayAvailable->finalPrice())</span>
            </div>
        </div>
    </div>
</x-app-layout>