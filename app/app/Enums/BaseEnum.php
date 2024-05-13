<?php

/**
 * This trait is used to get values in migrations
*/

namespace App\Enums;

trait BaseEnum {
    public static function forMigration(): array {
        return collect(self::cases())
            ->map(function ($enum) {
                if (property_exists($enum, "value")) return $enum->value;
                return $enum->name;
            })
            ->values()
            ->toArray();
    }
}