<?php

namespace App\Enums;

enum ReportStatus: string
{
    case Done = 'done';
    case Error = 'pending';
    case None = 'none';
}
