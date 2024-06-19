<?php
namespace App\Enums\Publication;

use App\Enums\BaseEnum;

enum RentType: string {
    
    use BaseEnum;
    case Cottage = 'Cabaña';
    case Department = 'Departamento';
    case Room = 'Habitación';
}

