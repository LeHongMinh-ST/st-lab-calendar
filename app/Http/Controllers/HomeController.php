<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Models\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function activities()
    {

        $serminars = Activity::where('type', ActivityType::Seminar)->get();

        return view('activities');
    }
}
