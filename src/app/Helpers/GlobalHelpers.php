<?php

use Illuminate\Support\Str;

if (!function_exists('normalizeVariants')) {
    function normalizeVariants(array $variants): string
    {
        ksort($variants);
        return json_encode($variants);
    }
}
