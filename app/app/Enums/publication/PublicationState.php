<?php
namespace App\Enums\Publication;

use App\Enums\BaseEnum;

enum PublicationState: string {
    
    use BaseEnum;
    case Unavailable = 'No disponible';
    case Available = 'Disponible';
    case Occupied = 'Ocupado';
}

