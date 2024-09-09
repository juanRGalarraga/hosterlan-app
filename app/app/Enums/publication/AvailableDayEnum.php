<?php

namespace App\Enums\Publication;

use App\Enums\BaseEnum;

enum AvailableDayEnum : string {

    use BaseEnum;
    case Unavailable = 'No disponible';
    case Available = 'Disponible';
    case Pending = 'Pendiente';

}