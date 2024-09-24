<?php
namespace App\Enums;

use App\Enums\BaseEnum;

enum DocumentTypeEnum: string {
    
    use BaseEnum;
    case DNI = 'DNI';
    case Passport = 'Pasaporte';
    case BirthCertificate = 'Acta de nacimiento';
}