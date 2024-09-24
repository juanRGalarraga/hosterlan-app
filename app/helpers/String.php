<?php

if( !function_exists('elipsis') ){
    /**
    * Summary. Corta $cad por el espacio en blanco siguiente a la posición $len y agrega $elipse al final.
    * @param string $cad La cadena a cortar.
    * @param int $len A los cuántos caracteres cortar.
    * @param string $elipse El caracter de sustitución.
    * @param bool $strict Pone el elipse exactamente en la posición $len y elimina el resto.
    * @return string el string cortado y reemplazado.
    */
    function elipsis($cad, $len = 30,  $strict = true, $elipse = null) {
        $result = $cad;
        if (empty($elipse)) { $elipse = "..."; }
        if (mb_strlen($cad) > $len) {
            if (!$strict) {
                $posSpace = mb_strpos($cad," ",$len);
                if (is_bool($posSpace) and ($posSpace == false)) {
                    $posSpace = mb_strlen($cad);
                }
                $posHyphen = mb_strpos($cad,"-",$len);
                if (!is_bool($posHyphen) and ($posHyphen < $posSpace)) {
                    $posSpace = $posHyphen;
                }
                if ($posSpace > 0) {
                    $result = mb_substr($cad,0,$posSpace).$elipse;
                } else { $result = $cad; }
            } else {
                $result = mb_substr($cad,0,($len-1)).$elipse;
            }
        }
        return $result;
    }
}

if(!function_exists('convert')){
    function convert(int|float $number, string $symbol = '$', int $decimals = 2){
        return $symbol . number_format($number, $decimals);
    }
}