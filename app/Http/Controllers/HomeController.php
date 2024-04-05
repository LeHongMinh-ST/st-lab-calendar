<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Enums\ActivityType;
use App\Models\Event;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    private const LIMIT_WEEKS = 4;

    public function activities(Request $request): View|Application|Factory
    {
        $now = Carbon::now()->startOfDay()->timestamp;

        $endDate = Carbon::now()->addWeeks(self::LIMIT_WEEKS)->timestamp;

        $year = $request->get('year');

        $pageLimit = $request->get('page', 1);

        $limit = $pageLimit * Constants::PER_PAGE_SEMINAR;

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
            ->when($year, function ($query, $year): void {
                $startYear = Carbon::createFromFormat('Y', $year)->startOfYear()->timestamp;
                $endYear = Carbon::createFromFormat('Y', $year)->endOfYear()->timestamp;
                $query->where('day', '>=', $startYear)->where('day', '<=', $endYear);
            })
            ->with(['user', 'team', 'activity'])
            ->orderBy('day', 'desc')
            ->limit($limit)
            ->get();

        $totalSeminar = Event::where('day', '<', $now)
            ->whereNotIn('id', $seminarIds)
            ->when($year, function ($query, $year): void {
                $startYear = Carbon::createFromFormat('Y', $year)->startOfYear()->timestamp;
                $endYear = Carbon::createFromFormat('Y', $year)->endOfYear()->timestamp;
                $query->where('day', '>=', $startYear)->where('day', '<=', $endYear);
            })
            ->get();

        $totalPage = (int) ceil($totalSeminar->count() / Constants::PER_PAGE_SEMINAR);

        return view('activities', compact('seminars', 'seminarOthers', 'pageLimit', 'totalPage'));
    }
}
