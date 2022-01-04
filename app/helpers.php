<?php

use App\Models\Setting;

if (!function_exists("getString")) {
    function getString($slug) {
        return ucwords(str_replace('_', ' ', $slug)); 
    }
}


if (!function_exists("getSetting")) {
    function getSetting($key, $default) {
        return Setting::where("key", $key)->first()->value ?? $default; 
    }
}