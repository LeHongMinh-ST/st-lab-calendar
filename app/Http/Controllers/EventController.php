<?php

namespace App\Http\Controllers;

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
        $startDay = $request->input('start', $now->startOfWeek()->format('Y-m-d'));
        $endDay = $request->input('end', $now->endOfWeek()->format('Y-m-d'));

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
