<?php

declare(strict_types=1);

namespace App\Casts;

use App\Common\Constants;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class TimeTimeStamp implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return Carbon::createFromTimestamp($value)->format(Constants::FORMAT_DATE_TIME);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return Carbon::createFromFormat(Constants::FORMAT_DATE_TIME, $value)->timestamp;
    }
}
