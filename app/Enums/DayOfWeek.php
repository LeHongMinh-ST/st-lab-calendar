<?php

namespace App\Enums;

enum DayOfWeek: int
{
    case Monday = 1;
    case Tuesday = 2;
    case Wednesday = 3;
    case Thursday = 4;
    case Friday = 5;
    case Saturday = 6;
    case Sunday = 0;

    public function description(): string
    {
        return match ($this) {
            self::Sunday => 'Chủ nhật',
            self::Monday => 'Thứ hai',
            self::Tuesday => 'Thứ ba',
            self::Wednesday => 'Thứ tư',
            self::Thursday => 'Thứ năm',
            self::Friday => 'Thứ sáu',
            self::Saturday => 'Thứ bảy',
        };
    }
}
