<?php

use nickurt\Plesk\Plesk;

if (!function_exists('plesk')) {
    function plesk()
    {
        return app(Plesk::class);
    }
}