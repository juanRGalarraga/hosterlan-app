<?php

if(!function_exists('convert')){
    function convert(int|float $number, string $symbol = '$', int $decimals = 2){
        return $symbol . number_format($number, $decimals);
    }
}