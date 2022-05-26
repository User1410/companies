<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Service{

    public static function getRandomImage($dirLink, $width = 480, $height = 640)
    {
        $url = "https://picsum.photos/$width/$height";
        $filename = uniqid().Str::random(17).'.png';

        try{
            $contents = file_get_contents($url);
        }catch(\Exception $e){
            return null;
        }

        try{
            Storage::disk($dirLink)->put($filename, $contents);
        }catch(\Exception $e){
            throw new \InvalidArgumentException('check your your file links');
        }
        
        return $filename;
    }
}