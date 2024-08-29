<div class="flex flex-col xs:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mx-auto">
    <div class="space-x-2 px-5 my-h-screen pt-3 overflow-y-auto overflow-x-hidden mcss-hover-show-scroll mcss-hide-scroll">
        <div class="bg-gray-800 text-white rounded-lg shadow-lg p-8 w-full max-w-md min-w-full min-h-full">
            <form id="publicationForm" name="publicationForm" action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                    <!-- Título -->
                    <h2 class="text-center text-xl font-bold mb-4">Días disponibles</h2>

                    <!-- Formulario de rango de fechas -->
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <x-form.date-range-picker idDateFrom="available_since" idDateTo="available_to" id="dateRangePicker"></x-form.date-range-picker>
                        <x-primary-button type="button" class="ml-3" id="buttonAddDates">{{__('Añadir')}}</x-primary-button>
                    </div>

                    <!-- Tabla con scroll -->
                    <div class="overflow-y-auto h-full">
                        <table class="min-w-full bg-gray-800 text-center">
                            <thead class="bg-gray-700 sticky top-0">
                                <tr>
                                    <th class="px-4 py-2 text-white">Desde</th>
                                    <th class="px-4 py-2 text-white">Hasta</th>
                                    <th class="px-4 py-2 text-white"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=0;$i<=20;$i++)
                                    <tr class="border-b border-gray-700">
                                        <td class="px-4 py-2">10/04/2023</td>
                                        <td class="px-4 py-2">10/05/2023</td>
                                        <td class="px-4 py-2">
                                            <button type="button" class="text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                            <button type="button" class="text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endfor
                                <!-- Agrega más filas según sea necesario -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div class="bottom-0 relative text-center justify-center mx-0 mb-6">
        <button form="publicationForm" type="submit" class="p-2 rounded-md w-full text-white border-2 border-blue-700 hover:bg-blue-700 focus:bg-blue-700">{{ __('Publicar') }}</button>
    </div>
</div>
