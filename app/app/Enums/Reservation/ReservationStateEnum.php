<?php
namespace App\Enums\Reservation;

use App\Enums\BaseEnum;

enum ReservationStateEnum: string {
    
    use BaseEnum;
    case PreReserved = 'Pre-Reservado';
    case Reserved = 'Reservado';
}