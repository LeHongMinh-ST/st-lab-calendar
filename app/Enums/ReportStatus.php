<?php

declare(strict_types=1);

namespace App\Enums;

enum ReportStatus: string
{
    case Done = 'done';
    case Error = 'pending';
    case None = 'none';
}
