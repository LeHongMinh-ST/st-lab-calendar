<?php

namespace App\Casts;

use App\Common\Constants;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class DateTimeStamp implements CastsAttributes
{

    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return Carbon::createFromTimestamp($value)->format(Constants::FORMAT_DATE);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes)
    {
        return  Carbon::createFromFormat(Constants::FORMAT_DATE, $value)->timestamp;
    }
}
