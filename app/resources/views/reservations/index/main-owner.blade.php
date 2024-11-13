@php
    use Carbon\Carbon;
@endphp
<x-app-layout>

    <x-slot:scripts>
        @vite([
            'resources/js/reservations/index/index.js',
        ])
    </x-slot:scripts>

    <div class="form-container p-40 grid-cols-200 px-auto h-screen">
        <h1 class="text-2xl font-bold form-title mb-6 dark:text-white">Reservas confirmadas </h1>
        @if($reservations->isEmpty())
            <p class="text-gray-600">{{__('No hay elementos para mostrar')}}.</p>
        @else
            <div class="overflow-x-auto mb-10">
                <table class="min-w-full bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="py-3 px-4 text-white">Fecha de Reserva</th>
                            <th class="py-3 px-4 text-white">Huesped</th>
                            <th class="py-3 px-4 text-white">Estado</th>
                            <th class="py-3 px-4 text-white">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($reservations as $reservation)                            
                            <tr class="border-b border-gray-600">
                                @php
                                    $since = new Carbon($reservation->availableDay->since);
                                    $to = new Carbon($reservation->availableDay->to);
                                @endphp
                                <td class="py-3 px-4 text-white">{{ $since->format('d/m/Y') . " hasta " . $to->format('d/m/Y') }}</td>
                                <td class="py-3 px-4 text-white">{{ $reservation->guest->user->name }}</td>
                                <td class="py-3 px-4">
                                    @if($reservation->state == \App\Enums\Reservation\ReservationStateEnum::PreReserved->name)
                                        <span class="text-yellow-500">Pre-reservado</span>
                                    @else
                                        <span class="text-green-500">Reservado</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('publications.show', ['publication' => $reservation->availableDay->publication]) }}" class="text-blue-500 underline">Ver publicación</a>
                                </td>
                                <td class="py-3 px-4">
                                    @if($reservation->state == \App\Enums\Reservation\ReservationStateEnum::PreReserved->name)
                                    <a href="{{ route('reservations.create', ['reservation' => $reservation]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Ver Reserva</a>
                                    @elseif ($reservation->state == \App\Enums\Reservation\ReservationStateEnum::Reserved->name)
                                    <a href="{{ route('reservations.show', ['reservation' => $reservation]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Ver Reserva</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
