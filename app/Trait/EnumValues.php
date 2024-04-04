<?php

declare(strict_types=1);

namespace App\Trait;

trait EnumValues
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
