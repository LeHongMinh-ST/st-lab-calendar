<?php

namespace App\Enums;
enum UserStatus: string
{
    case Active = 'active';
    case Inactive = 'inactive';

    public function name(): string
    {
        return self::getName($this);
    }

    public static function displayAll(): array
    {
        $display = [];
        foreach (self::cases() as $value) {
            $display[$value->value] = self::getName($value);
        }
        return $display;
    }

    public static function getName(self $value): string
    {
        return match ($value) {
            self::Active => trans('user.status.active'),
            self::Inactive => trans('user.status.inactive'),
        };
    }
}

