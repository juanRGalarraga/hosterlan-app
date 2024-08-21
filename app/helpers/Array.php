<?php


if( !function_exists('anyArrayIsEmpty') ){
    function anyArrayIsEmpty($array) {
        if (!is_array($array) || empty($array)) {
            return false;
        }
    
        foreach ($array as $element) {
            if (is_array($element)) {
                if (!isAnyArrayEmpty($element)) {
                    return false;
                }
            } elseif (empty($element) && $element !== 0 && $element !== '0') {
                return false;
            }
        }
    
        return true;
    }

}

