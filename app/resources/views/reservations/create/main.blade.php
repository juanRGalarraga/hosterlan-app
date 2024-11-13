@php
    $publication = $reservation->availableDay->publication;
@endphp
<x-app-layout>
    <div class="form-container p-52 grid grid-cols-4 px-auto">
        <div class="col-span-2 col-start-1">
            <h2 class="text-2xl font-bold form-title mb-6 dark:text-white">{{__('Confirmación de Reserva')}}</h2>

            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    @foreach ($errors->all() as $error)
                        <span class="font-medium">{{$error}}!</span><br>
                    @endforeach
                </div>
            @endif
            
            <form id="confirmReservationForm" name="confirmReservationForm" action="{{route('reservations.store', ['reservation_id' => $reservation->id])}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-300">{{__('Nombre Completo')}}</label>
                    <input type="text" readonly id="name" name="name" value="{{Auth::user()->name}}" required class="mt-1 block w-full px-3 py-2 border-0 rounded-md shadow-sm focus:outline-none placeholder-gray-400 sm:text-sm dark:bg-gray-900 text-white">
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-300">{{__('Correo Electrónico')}}</label>
                    <input type="email" id="email" name="email" value="{{old('email', Auth::user()->email)}}" required readonly class="mt-1 block w-full px-3 py-2 border-0 rounded-md shadow-sm focus:outline-none placeholder-gray-400 sm:text-sm dark:bg-gray-900 text-white focus:border-0">
                </div>

                <div class="flex flex-row w-full">
                    <div class="mb-4 w-full">
                        <label for="since" class="block text-sm font-medium text-gray-300">{{__('Fecha de Llegada')}}</label>
                        <input type="text" id="since" name="since" value="{{$reservation->availableDay->since}}"  readonly class="mt-1 block w-full px-3 py-2 border-0 rounded-md shadow-sm focus:outline-none placeholder-gray-400 sm:text-sm dark:bg-gray-900 text-white">
                    </div>
        
                    <div class="mb-4 w-full">
                        <label for="to" class="block text-sm font-medium text-gray-300">{{__('Fecha de Salida')}}</label>
                        <input type="text" id="to" name="to" value="{{$reservation->availableDay->to}}" readonly class="mt-1 block w-full px-3 py-2 border-0 rounded-md shadow-sm placeholder-gray-400 focus:outline-none sm:text-sm dark:bg-gray-900 text-white">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="phoneNumber" class="block text-sm font-medium text-gray-300">{{__('Teléfono de contacto')}}</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" value="{{old('phoneNumber', Auth::user()->getDefaultPhone())}}" required readonly class="mt-1 block w-full px-3 py-2 border-0 rounded-md shadow-sm placeholder-gray-400 focus:outline-0 sm:text-sm dark:bg-gray-900 text-white">
                </div>
    
                <!-- <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-300">{{__('Mensaje Adicional')}}</label>
                    <textarea  value="{{old('message')}}" id="message" name="message" rows="4" maxlength="200" placeholder="{{__('Max. 200 caract.')}}" class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white">{{old('message')}}</textarea>
                </div> -->
    
                <div>
                    <button type="submit" form="confirmReservationForm" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                        {{__('Confirmar Reserva')}}
                    </button>
                </div>
            </form>
        </div>

        <div class="col-span-2 md:col-span-2 ml-3 col-start-3">
            <x-publication.mini-card
                srcImage="{{$publication->getFirstPicture()}}"
                title="{{$publication->title}}"
                subtitle=""
            ></x-publication.mini-card>

            <h2 class="text-2xl font-bold form-title mb-6 dark:text-white">{{__('Detalles del precio')}}</h2>
            <div class="flex justify-between">
                <span class="dark:text-white">{{convert($publication->price)}} por {{$reservation->availableDay->dayCount()}} noches</span>
                <span class="dark:text-white">{{convert($reservation->availableDay->finalPrice())}}</span>
            </div>
        </div>
    </div>
</x-app-layout>