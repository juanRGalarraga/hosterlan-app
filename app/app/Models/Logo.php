<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Logo 
{
    public static function get(){
        $file = env('APP_LOGO', '');
        $content = asset($file);
        debugbar()->debug($content);
        if(!$content){
            Log::warning('Logo not found');
            return '';
        }
        return $content;
    }

    public static function banner(){
        $file = env('APP_BANNER', '');
        $content = asset($file);
        debugbar()->debug($content);
        if(!$content){
            Log::warning('Banner not found');
            return '';
        }
        return $content;
    }

    public static function name(){
        $file = env('APP_LOGO_NAME', '');
        $content = asset($file);
        debugbar()->debug($content);
        if(!$content){
            Log::warning('Banner not found');
            return '';
        }
        return $content;
    }
}
