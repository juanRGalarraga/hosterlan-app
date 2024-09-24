<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Logo 
{
    public static function get(){
        $file = env('APP_LOGO', 'default-logo.png');
        $content = asset($file);
        if(!$content){
            Log::warning('Logo not found');
            return '';
        }
        return $content;
    }
}
