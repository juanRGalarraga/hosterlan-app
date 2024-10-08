<div id="reserveDayModal" tabindex="-1" aria-hidden="true" class="hidden bg-gray-800/70 z-[100] overflow-y-auto overflow-x-hidden absolute flex justify-center top-0 right-0 left-0 z-90  items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="reserveDayModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form class="p-4 md:p-5" name="formReserveDay" id="formReserveDay" method="POST" action="{{route('reservations.pre-reserve')}}">
                @csrf
                <input type="hidden" name="available_day_id" id="available_day_id" value="{{$publication->id}}">
                <input type="hidden" name="publication_id" value="{{$publication->id}}">
                @if (Auth::user()->isGuest())
                    <input type="hidden" name="guest_id" value="{{Auth::user()->guest->id}}">
                @endif
                
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="text-center col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{__('Día')}}
                        </h3>
                        <span class="text-md text-white" id="reserveDayText">[fecha]</span>
                    </div>
                    <div class="col-span-2" hidden>
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{__('Adjuntar mensaje (opcional)')}}:</label>
                        <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>   
                    </div>
                </div>
                <div class="text-center">
                    <x-primary-button type="submit" form="formReserveDay">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        {{__('Solicitar reserva')}}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div> 