<?php

namespace App\Http\Controllers\Publication;
use PHPUnit\Framework\MockObject\Generator\InvalidMethodNameException;
use Ramsey\Collection\Exception\InvalidPropertyOrMethod;


class PublicationStep {

    static array $step = [];

    private const STEPS = [
        1 => ['view' => 'publications.create.form-step-1-main'],
        2 => ['view' => 'publications.create.form-step-2-main']
    ];

    public static function getStep(string $step) : self {
        if(!isset(self::STEPS[$step])){
            throw new InvalidPropertyOrMethod("Ivalid argument. Step not exists");
        }

        self::$step = self::STEPS[$step];

        return new self;
    }

    public static function view() : string {
        if(empty(self::$step)){
            throw new InvalidMethodNameException("Ivalid method. You sure to call getStep before");
        }
        return self::$step['view'];
    }

}