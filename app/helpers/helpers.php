<?php

use Illuminate\Support\Str;

function generateSlug($text) {
    $slug = Str::slug($text);
    return $slug;
}