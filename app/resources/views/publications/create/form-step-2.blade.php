<div class="flex flex-col xs:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mx-auto">
    <div class="space-x-2 px-5 my-h-screen pt-3 overflow-y-auto overflow-x-hidden mcss-hover-show-scroll mcss-hide-scroll my-h-screen-form-step-2">
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
                        @include('publications.create.form-step-2-table')
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div class="bottom-0 relative text-center justify-center mx-0 mb-6">
        <button form="publicationForm" type="submit" class="p-2 rounded-md w-full text-white border-2 border-blue-700 hover:bg-blue-700 focus:bg-blue-700">{{ __('Publicar') }}</button>
    </div>
</div>
