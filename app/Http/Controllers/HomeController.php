<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Models\Event;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    private const LIMIT_WEEKS = 2;
    public function activities(): View|Application|Factory
    {
        $now = Carbon::now()->startOfDay()->timestamp;
        $endDate = Carbon::now()->addWeeks(self::LIMIT_WEEKS)->timestamp;

        $seminars = Event::where('day', '>=', $now)
            ->where('day', '<=', $endDate)
            ->whereHas('activity', function ($query): void {
                $query->where('type', ActivityType::Seminar);
            })
            ->with(['user', 'team', 'activity'])
            ->orderBy('day')
            ->get();

        $seminarIds = $seminars->pluck('id')->toArray();

        $seminarOthers = Event::where('day', '<', $now)
            ->whereNotIn('id', $seminarIds)
            ->with(['user', 'team', 'activity'])
            ->orderBy('day')
            ->get();

        return view('activities', compact('seminars', 'seminarOthers'));
    }
}
