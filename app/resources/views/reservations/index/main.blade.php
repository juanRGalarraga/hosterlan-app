<x-app-layout>


        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-4">Reservas y Pre-reservas del Huésped</h1>
    

            @if($reservations->isEmpty())
                <p class="text-gray-600">No hay reservas o pre-reservas registradas.</p>
            @else

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="py-3 px-4">ID</th>
                                <th class="py-3 px-4">Fecha de Reserva</th>
                                <th class="py-3 px-4">Estado</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                                <tr class="border-b">
                                    <td class="py-3 px-4">{{ $reservation->id }}</td>
                                    <td class="py-3 px-4">{{ $reservation->created_at->format('d-m-Y') }}</td>
                                    <td class="py-3 px-4">
                                        @if($reservation->state == \App\Enums\Reservation\ReservationStateEnum::PreReserved->name)
                                            <span class="text-yellow-500">Pre-reservado</span>
                                        @else
                                            <span class="text-green-500">Reservado</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('publications.show', $reservation->publication_id) }}" class="text-blue-500 underline">
                                            Ver publicación
                                        </a>
                                    </td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('reservations.show', $reservation->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
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
