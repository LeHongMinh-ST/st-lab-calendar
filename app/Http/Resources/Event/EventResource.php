<?php

declare(strict_types=1);

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
        $startTime = "{$this->day} {$this->start_time}";
        $endTime = "{$this->day} {$this->end_time}";
        $startTime = Carbon::parse($startTime)->format(Constants::FORMAT_DATE_TIME_API);
        $endTime = Carbon::parse($endTime)->format(Constants::FORMAT_DATE_TIME_API);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'day' => $this->day,
            'status' => $this->status,
            'user' => new UserResource($this->user),
            'team' => new TeamResource($this->team),
            'start' => $startTime,
            'end' => $endTime,
        ];
    }
}
