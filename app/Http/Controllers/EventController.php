<?php

namespace App\Http\Controllers;

use App\Common\Constants;
use App\Enums\Status;
use App\Http\Resources\Event\EventCollection;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request): EventCollection
    {
        $now = Carbon::now();
        $startDay = $request->input('start', $now->startOfWeek()->format(Constants::FORMAT_DATE));
        $endDay = $request->input('end', $now->endOfWeek()->format(Constants::FORMAT_DATE));

        $startCarbon = Carbon::parse($startDay)->timestamp;
        $endCarbon = Carbon::parse($endDay)->timestamp;

        $events = Event::where('day', '>=', $startCarbon)
            ->where('day', '<=', $endCarbon)
            ->where('status', Status::Active)
            ->with(['user', 'team'])
            ->get();

        return new EventCollection($events);

    }
}
