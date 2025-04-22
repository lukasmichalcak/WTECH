<?php

use Illuminate\Support\Str;
use \Illuminate\Support\Facades\Log;

if (!function_exists('normalizeVariants')) {
    function normalizeVariants(array $variants): string
    {
        ksort($variants);
        return json_encode($variants);
    }
}

if (!function_exists('sortVariants')) {
    function sortVariants(array $variants): array
    {
        ksort($variants);
        return $variants;
    }
}

if (!function_exists('isStepComplete')){
    function isStepComplete(string $step): bool
    {
        $data = session("checkout.{$step}", []);

        return match($step) {
            'invoice' => isset($data['first_name'], $data['last_name'], $data['email'], $data['address'], $data['city'], $data['zip_code'], $data['country']),
            'shipping' => isset($data['transport_option']),
            'payment' => isset($data['payment_method']),
            default => false,
        };
    }
}

