<?php

declare(strict_types=1);

namespace App\Enums;

enum ActivityType: string
{
    case Report = 'work';
    case Seminar = 'seminar';
    case Other = 'other';

    public function description(): string
    {
        return match ($this) {
            self::Report => 'Làm việc - Nghiên cứu',
            self::Seminar => 'Hội thảo - Seminar',
            self::Other => 'Khác',
        };
    }
}
