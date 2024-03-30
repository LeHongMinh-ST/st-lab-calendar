<?php

namespace App\Http\Resources\Event;

use App\Common\Constants;
use App\Http\Resources\Team\TeamResource;
use App\Http\Resources\User\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $day = Carbon::createFromTimestamp($this->day)->format(Constants::FORMAT_DATE);
        $startTime = "{$day} {$this->start_time}";
        $endTime = "{$day} {$this->end_time}";
        $startTime = Carbon::parse($startTime)->format(Constants::FORMAT_DATE_TIME_API);
        $endTime = Carbon::parse($endTime)->format(Constants::FORMAT_DATE_TIME_API);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'day' => $day,
            'status' => $this->status,
            'user' => new UserResource($this->user),
            'team' => new TeamResource($this->team),
            'start' =>$startTime,
            'end' => $endTime,
        ];
    }
}
