<?php

declare(strict_types=1);

namespace App\Enums;

enum RoomStatus: string
{
    case Normal = 'normal';
    case Error = 'error';
}
