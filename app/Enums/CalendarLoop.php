<?php

namespace App\Enums;

use App\Trait\EnumOptions;
use App\Trait\EnumValues;

enum CalendarLoop: string
{
    use EnumOptions;
    use EnumValues;

    case None = 'none';
    case Daily = 'daily';
    case Weekly = 'weekly';

    public function description(): string
    {
        return match ($this) {
            self::None => 'Không lặp lại',
            self::Daily => 'Hàng ngày',
            self::Weekly => 'Hàng tuần',
        };
    }

}
