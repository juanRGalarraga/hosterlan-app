<?php

namespace App\Enums\User;
use App\Enums\BaseEnum;

enum Type: string {

    use BaseEnum;
    case Owner = 'owner';
    case Guest = 'guest';
}