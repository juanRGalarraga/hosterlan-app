<?php

namespace App\Http\Controllers\Publication;
use PHPUnit\Framework\MockObject\Generator\InvalidMethodNameException;
use Ramsey\Collection\Exception\InvalidPropertyOrMethod;


class PublicationStep {

    static string $step = [];

    private const STEPS = [
        1 => ['method' => 'createFirstStep', 'view' => 'publications.create.form'],
        2 => ['method' => 'createSecondStep', 'view' => 'publications.create.form-step-2']
    ];

    public static function getStep(string $step){
        if(!isset(self::STEPS[$step])){
            throw new InvalidPropertyOrMethod("Ivalid argument. Step not exists");
        }

        self::$step = self::STEPS[$step];

        return new self;
    }

    public static function view(){
        if(empty(self::$step)){
            throw new InvalidMethodNameException("Ivalid method. You sure to call getStep before");
        }
        return self::$step['view'];
    }

    public static function method(){
        if(empty(self::$step)){
            throw new InvalidMethodNameException("Ivalid method. You sure to call getStep before");
        }
        return self::$step['method'];
    }

    public static function setStep(string $step){
        self::$step = $step;
        return new self;
    }

}