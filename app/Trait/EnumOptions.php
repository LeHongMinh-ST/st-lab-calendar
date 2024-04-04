<?php

declare(strict_types=1);

namespace App\Trait;

use Illuminate\Support\Str;

trait EnumOptions
{
    public static function options(): array
    {
        $cases = static::cases();
        $options = [];
        foreach ($cases as $case) {
            $label = $case->description() ?? $case->name;
            if (Str::contains($label, '_')) {
                $label = Str::replace('_', ' ', $label);
            }
            $options[] = [
                'value' => $case->value,
                'label' => Str::title($label),
            ];
        }

        return $options;
    }
}
