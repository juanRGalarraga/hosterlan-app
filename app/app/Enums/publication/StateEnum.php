<?php
namespace App\Enums\Publication;

use App\Enums\BaseEnum;

enum StateEnum: string {
    
    use BaseEnum;
    case Draft = 'Borrador';
    case Published = 'Publicado';
}