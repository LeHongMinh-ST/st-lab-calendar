<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Draft = 'draft';

    public static function displayAll(): array
    {
        $display = [];
        foreach (self::cases() as $value) {
            $display[$value->value] = self::getName($value);
        }

        return $display;
    }

    public static function displayAllStatusApprove(): array
    {
        $display = [];
        foreach ([self::Draft, self::Active] as $value) {
            $display[$value->value] = self::getName($value);
        }

        return $display;
    }

    public static function getName(self $value): string
    {
        return match ($value) {
            self::Active => trans('calendar.status.active'),
            self::Inactive => trans('calendar.status.inactive'),
            self::Draft => trans('calendar.status.draft'),
        };
    }
}
