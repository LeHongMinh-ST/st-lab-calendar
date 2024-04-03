<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function activities(): View|Application|Factory
    {
        $now = Carbon::now();

        $endDate = Carbon::now()->addWeeks(2);

        return view('activities', compact('seminars'));
    }
}
