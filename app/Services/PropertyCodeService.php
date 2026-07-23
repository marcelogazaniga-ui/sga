<?php

namespace App\Services;

use App\Models\Property;

class PropertyCodeService
{
    public static function generate(): string
    {
        $next = Property::max('id') + 1;

        return sprintf('IMV-%06d', $next);
    }
}
