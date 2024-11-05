@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4">Notificaciones</h1>
        <ul>
            @foreach ($notifications as $notification)
                <li class="mb-4 p-4 border rounded-lg">
                    <p>{{ $notification->data['message'] }}</p>
                    <a href="{{ $notification->data['url'] }}" class="text-blue-500 hover:underline">Ver reserva</a>
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-green-500 hover:underline ml-2">Marcar como leída</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection