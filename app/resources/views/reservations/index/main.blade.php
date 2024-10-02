<x-app-layout>
    <div class="form-container p-40 grid-cols-200 px-auto h-screen">
        <h1 class="text-2xl font-bold form-title mb-6 dark:text-white">Reservas y Pre-reservas </h1>

        @if($reservations->isEmpty())
            <p class="text-gray-600">No hay reservas o pre-reservas registradas.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="py-3 px-4  text-white">Fecha de Reserva</th>
                            <th class="py-3 px-4 text-white">Estado</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr class="border-b border-gray-600">
                               
                                <td class="py-3 px-4 text-white">{{ $reservation->created_at->format('d-m-Y') }}</td>
                                <td class="py-3 px-4">
                                    @if($reservation->state == \App\Enums\Reservation\ReservationStateEnum::PreReserved->name)
                                        <span class="text-yellow-500">Pre-reservado</span>
                                    @else
                                        <span class="text-green-500">Reservado</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('publications.show', ['publication' => $reservation->availableDay->publication]) }}" class="text-blue-500 underline">
                                        Ver publicación
                                    </a>
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('reservations.create', ['reservation' => $reservation]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                        Ver Reserva
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="mt-4">
                {{ $reservations->links() }} 
            </div>
        @endif
    </div>
</x-app-layout>
