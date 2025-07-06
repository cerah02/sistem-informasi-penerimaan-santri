<?php

use App\Models\Beranda;

if (!function_exists('beranda')) {
    function beranda($key, $default = null)
    {
        return Beranda::where('key', $key)->value('value') ?? $default;
    }
}
