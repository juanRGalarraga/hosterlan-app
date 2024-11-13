@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reservas para la publicación: {{ $publication->title }}</h2>
    
    @if($reservations->isEmpty())
        <p>No hay reservas para esta publicación.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre del Huésped</th>
                    <th>Fecha de Reserva</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->guest->name }}</td>
                        <td>{{ $reservation->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
