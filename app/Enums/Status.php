<?php

namespace App\Enums;
enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Deleted = 'deleted';

    public function name(): string
    {
        return self::getName($this);
    }

    public static function displayAll($value = null): mixed
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

