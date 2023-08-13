<?php

use Illuminate\Support\Str;

if (!function_exists('generateSlug')) {

    function generateSlug($text) {
        $slug = Str::slug($text);
        return $slug;
    }
    
}