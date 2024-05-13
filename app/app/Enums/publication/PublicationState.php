<?php
namespace App\Enums;

use App\Enums\BaseEnum;

enum PublicationState: string {
    
    use BaseEnum;
    case Unavailable = 'No disponible';
    case Available = 'Disponible';
    case Occupied = 'Ocupado';
}

