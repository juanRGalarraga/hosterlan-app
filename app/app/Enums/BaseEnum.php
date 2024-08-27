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
    
    /**
     * Search case by name
     * @param string $name
     * @throws \ValueError
     * @return string
     */
    public static function fromName(string $name): string
    {
        foreach (self::cases() as $case) {
            if( $name === $case->name ){
                return $case->value;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum " . self::class );
    }
}