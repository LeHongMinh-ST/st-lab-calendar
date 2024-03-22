<?php

namespace App\Enums;

enum ActivityType:string
{
    case Report = 'work';
    case Seminar = 'seminar';
    case Other = 'other';
}


