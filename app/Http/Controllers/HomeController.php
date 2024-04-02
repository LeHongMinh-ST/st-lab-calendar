<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Models\Activity;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function activities(): View|Application|Factory
    {

        $seminars = Activity::where('type', ActivityType::Seminar)->get();

        return view('activities', compact('seminars'));
    }
}
