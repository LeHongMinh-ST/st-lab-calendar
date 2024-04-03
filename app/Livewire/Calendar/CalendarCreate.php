<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Common\Constants;
use App\Enums\ActivityType;
use App\Enums\CalendarLoop;
use App\Models\Calendar;
use App\Models\Team;
use App\Services\CalendarService;
use DateTime;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CalendarCreate extends Component
{
    #[Validate('required', as: 'tiêu đề')]
    public string $title = '';

    #[Validate('required', as: 'ngày bắt đầu')]
    public string $startDate = '';

    #[Validate('required', as: 'ngày kết thúc')]
    public string $endDate = '';

    #[Validate('required', as: 'thời gian bắt đầu')]
    public string $startTime = '';

    #[Validate('required', as: 'thời gian kết thúc')]
    public string $endTime = '';

    public CalendarLoop $loop = CalendarLoop::None;

    public array $dayOfWeek = [];

    public ActivityType $activityType = ActivityType::Report;

    public Collection|array $userTeams = [];

    public array $dayOfWeekFromStartDateToEndDate = [];

    public int $teamId = 0;

    public string $seminarUser = '';

    public string $seminarContent = '';

    public bool $isLoading = false;

    protected $listeners = [
        'update-start-date' => 'updateStartDate',
        'update-end-date' => 'updateEndDate',
    ];

    public function mount(): void
    {
        $this->startDate = Carbon::now()->format(Constants::FORMAT_DATE);
        $this->endDate = Carbon::now()->format(Constants::FORMAT_DATE);
        $this->startTime = Carbon::now()->format(Constants::FORMAT_TIME);
        $this->endTime = Carbon::now()->addHour()->format(Constants::FORMAT_TIME);
        $this->userTeams = Team::where('user_id', auth()->id())->get();
        $this->teamId = $this->userTeams->first()?->id ?? 0;
    }

    public function submit(): ?RedirectResponse
    {
        $this->validate();

        if ( ! $this->isValidate()) {
            return null;
        }

        if ( ! $this->isLoading) {
            $this->isLoading = true;

            DB::beginTransaction();
            try {
                $calendar = new Calendar();
                $calendar->title = $this->title;
                $calendar->start_time = $this->startTime;
                $calendar->end_time = $this->endTime;
                $calendar->start_day = $this->startDate;
                $calendar->end_day = $this->endDate;
                $calendar->loop = $this->loop;
                $calendar->date_of_week = $this->dayOfWeek;
                $calendar->team_id = $this->teamId;
                $calendar->save();

                CalendarService::forCalendar($calendar)
                    ->withActivityType($this->activityType)
                    ->withSeminarUser($this->seminarUser)
                    ->withContent($this->seminarContent)
                    ->createCalendarEvent();

                DB::commit();
                $this->dispatch('alert', type: 'success', message: 'Tạo lịch thành công!');
                //                return redirect()->route('calendar.index');
            } catch (Exception $e) {
                DB::rollBack();
                Log::error('Create Calendar', [
                    'method' => __METHOD__,
                    'message' => $e->getMessage(),
                ]);
                $this->dispatch('alert', type: 'error', message: 'Có lỗi xảy ra, vui lòng thử lại sau!');
            }
            $this->isLoading = false;
        }

        return null;

    }

    public function updated($field): void
    {
        $this->resetValidation($field);
    }

    public function render(): View|Application|Factory
    {
        return view('livewire.calendar.calendar-create');
    }

    public function updatingActivityType(&$value): void
    {
        if (is_string($value)) {
            $value = ActivityType::fromValue($value);

            if (ActivityType::Seminar === $value) {
                $this->endDate = $this->startDate;
            }
        }
    }

    public function updatedStartTime($value): void
    {
        if ($value) {
            $this->endTime = Carbon::parse($value)->addHour()->format(Constants::FORMAT_TIME);
        }
    }

    public function updateStartDate($value): void
    {
        if ($value) {
            $this->resetValidation('startDate');
        }
        $this->startDate = str_replace('/', '-', $value);

        if (CalendarLoop::Weekly === $this->loop) {
            $this->setDayOfWeekFromStartDateToEndDate();
        }

        if (ActivityType::Seminar === $this->activityType) {
            $this->endDate = $this->startDate;
        }
    }

    public function updateEndDate($value): void
    {
        if ($value) {
            $this->resetValidation('endDate');
        }
        $this->endDate = str_replace('/', '-', $value);

        if (CalendarLoop::Weekly === $this->loop) {
            $this->setDayOfWeekFromStartDateToEndDate();
        }
    }

    public function updatingLoop(&$value): void
    {
        if (is_string($value)) {
            $value = CalendarLoop::fromValue($value);
        }

        if (CalendarLoop::None === $value) {
            $this->dayOfWeek = [];
        }

        if (CalendarLoop::Weekly === $value) {
            $this->setDayOfWeekFromStartDateToEndDate();
        }
    }

    public function handleUpdateDayOfWeek($value): void
    {
        if ( ! $this->isSelectDayOfWeek($value)) {
            return;
        }

        if (in_array($value, $this->dayOfWeek)) {
            $this->dayOfWeek = array_diff($this->dayOfWeek, [$value]);
        } else {
            $this->dayOfWeek[] = $value;
        }
    }

    public function setDayOfWeekFromStartDateToEndDate(): void
    {
        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);
        $dayOfWeek = [];
        while ($startDate->lte($endDate)) {
            $dayOfWeek[] = $startDate->dayOfWeek;
            $startDate->addDay();
        }
        $this->dayOfWeekFromStartDateToEndDate = $dayOfWeek;
    }

    #[Computed]
    public function isActiveDayOfWeek($value): bool
    {
        return in_array($value, $this->dayOfWeek);
    }

    #[Computed]
    public function isSelectDayOfWeek($value): bool
    {
        return in_array($value, $this->dayOfWeekFromStartDateToEndDate);
    }

    #[Computed]
    public function totalTime(): string
    {
        if ($this->startTime && $this->endTime) {
            $start = new DateTime($this->startTime);
            $end = new DateTime($this->endTime);

            return $start->diff($end)->format('%h giờ %i phút');
        }

        return '';
    }

    #[Computed]
    public function maxTime(): string
    {
        if ($this->startDate && $this->endDate) {
            if ($this->startDate === $this->endDate) {
                $startTime = Carbon::parse($this->startTime);

                return $startTime->copy()->subMinutes(30)->format(Constants::FORMAT_TIME);
            }
        }

        return '';
    }

    #[Computed]
    public function showOptionLoop(): bool
    {
        return CalendarLoop::Weekly === $this->loop;
    }

    #[Computed]
    public function showEndDate(): bool
    {
        return CalendarLoop::None !== $this->loop;
    }

    #[Computed]
    public function totalWeeks(): int
    {
        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);

        return $startDate->diffInWeeks($endDate) + 1;
    }

    #[Computed]
    public function showLoop(): bool
    {
        return ActivityType::Seminar !== $this->activityType;
    }

    private function isValidate(): bool
    {
        if (CalendarLoop::Weekly === $this->loop && 0 === count($this->dayOfWeek)) {
            $this->dispatch('alert', type: 'error', message: 'Vui lòng chọn ít nhất một ngày trong tuần!');

            return false;
        }

        if (ActivityType::Seminar === $this->activityType && ! $this->seminarUser) {
            $this->dispatch('alert', type: 'error', message: 'Vui lòng nhập tên người trình bày!');

            return false;

        }

        if (ActivityType::Seminar === $this->activityType && ! $this->seminarContent) {
            $this->dispatch('alert', type: 'error', message: 'Vui lòng nhập nội dung buổi seminar!');

            return false;
        }

        if ($this->startTime >= $this->endTime) {
            $this->dispatch('alert', type: 'error', message: 'Thời gian kết thúc phải lớn hơn thời gian bắt đầu!');

            return false;
        }

        if ($this->startDate > $this->endDate) {
            $this->dispatch('alert', type: 'error', message: 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu!');

            return false;
        }

        return true;
    }
}
