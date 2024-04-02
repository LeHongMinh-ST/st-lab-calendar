<?php

namespace App\Enums;
enum Role: string
{
    case Admin = 'admin';
    case User = 'user';

    public function name(): string
    {
        return self::getName($this);
    }

    /**
     * all
     *
     * @return array
     */
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
            self::Admin => trans('user.role.admin'),
            self::User => trans('user.role.user'),
        };
    }

}

