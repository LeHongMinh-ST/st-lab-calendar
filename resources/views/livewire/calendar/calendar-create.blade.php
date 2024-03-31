@php
    use App\Enums\CalendarLoop;
    use App\Enums\ActivityType;
    use App\Enums\DayOfWeek;
@endphp
<div class="row calendar-create">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-calendar"></i>
                Thông tin lịch
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="title" class="col-form-label">
                            Tiêu đề <span class="required">*</span>
                        </label>
                        <input wire:model.live="title" type="text" id="title" class="form-control">
                        @error('title')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <label for="title" class="col-form-label">
                            Nhóm<span class="required">*</span>
                        </label>
                        <select type="text" id="title" class="form-select" wire:model.live="teamId">
                            @foreach($userTeams as $userTeam)
                                <option value="{{$userTeam->id}}">{{ $userTeam->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label for="title" class="col-form-label">
                            Hoạt động<span class="required">*</span>
                        </label>
                        <select type="text" id="title" class="form-select" wire:model.live="activityType">
                            @foreach(ActivityType::cases() as $activityType)
                                <option value="{{$activityType->value}}">{{ $activityType->description() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bold">
                <i class="ph-clock"></i>
                Thời gian
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="title" class="col-form-label">
                            Ngày bắt đầu <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model="startDate" type="text" id="startDate" value="{{ $this->startDate }}"
                                   class="form-control datepicker-basic datepicker-input">
                        </div>
                        @error('startDate')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror

                    </div>
                    <div class="col-12 col-md-6 @if(!$this->showLoop) d-none @endif" wire:transition>
                        <label for="title" class="col-form-label">
                            Ngày kết kúc <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model.live="endDate" type="text" id="endDate" value="{{ $this->endDate }}"
                                   class="form-control datepicker-basic datepicker-input ">
                        </div>
                        @error('endDate')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="title" class="col-form-label">
                            Thời gian <span class="required">*</span>
                        </label>
                        <div class="row">
                            <div class="col-md-4 col-5">
                                <input type="time" class="form-control" wire:model.live="startTime" value="{{ $this->startTime }}">
                            </div>
                            <div class="col-md-1 col-2 d-flex align-items-center justify-content-center">
                                <div class="tilde d-flex align-items-center justify-content-center">~</div>
                            </div>
                            <div class="col-md-4 col-5">
                                <input type="time" class="form-control" wire:model.live="endTime" value="{{ $this->endTime }}"
                                       max="{{$this->maxTime}}">
                            </div>
                            @if($this->totalTime)
                                <div class="col-md-3 col-12 d-flex align-items-center mt-2 mt-md-0">
                                    ({{$this->totalTime}})
                                </div>
                            @endif

                        </div>
                    </div>
                    @if($this->showLoop)
                        <div class="col-12 col-md-12" wire:transition>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="title" class="col-form-label">
                                        Lặp lại
                                    </label>
                                    <select type="text" id="title" class="form-select" wire:model.live="loop">
                                        @foreach(CalendarLoop::cases() as $calendarLoop)
                                            <option
                                                value="{{$calendarLoop->value}}">{{ $calendarLoop->description() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($this->showOptionLoop)
                                    <div class="col-md-6 col-12 d-md-flex align-items-center" wire:transition>
                                        <div class="text mt-4">
                                            Tổng số tuần: {{$this->totalWeeks}}
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif

                </div>

                @if($this->showOptionLoop)
                    <div class="row" wire:transition>
                        <div class="col-12">
                            <label for="title" class="col-form-label">
                                Chọn ngày lặp lại trong tuần <span class="required">*</span>
                            </label>
                            <div class="list-day-of-week">
                                @foreach(DayOfWeek::cases() as $dayOfWeek)
                                    <div
                                        class="item-day-of-week @if(!$this->isSelectDayOfWeek($dayOfWeek->value)) disabled @endif @if($this->isActiveDayOfWeek($dayOfWeek->value)) active @endif "
                                        wire:click="handleUpdateDayOfWeek({{$dayOfWeek->value}})">
                                        <div class="card">
                                            <div class="card-body">
                                                {{$dayOfWeek->description()}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($this->activityType == ActivityType::Seminar)
            <div class="card" wire:transition>
                <div class="card-header bold">
                    <i class="ph-projector-screen-chart"></i>
                    Hội thảo - Serminar
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="title" class="col-form-label">
                                Tên người trình bày <span class="required">*</span>
                            </label>
                            <input wire:model.live="seminarUser" type="text" id="seminarUser" class="form-control">

                        </div>
                        <div class="col-12">
                            <label for="title" class="col-form-label">
                                Nội dung <span class="required">*</span>
                            </label>
                            <textarea wire:model.live="seminarContent"  id="seminarUser" class="form-control" rows="5"></textarea>

                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
    <div class="col-md-3 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex align-items-center gap-1">
                <button class="btn btn-primary" @click="$wire.submit">
                    <i class="ph-floppy-disk"></i> Lưu
                </button>
                <button class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</button>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(function () {
        const dpBasicElementStartDate = document.querySelector('#startDate');
        if (dpBasicElementStartDate) {
            new Datepicker(dpBasicElementStartDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementStartDate.addEventListener('changeDate', function (event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-start-date', { value: formattedDate })
            });
        }


        const dpBasicElementEndDate = document.querySelector('#endDate');
        if (dpBasicElementStartDate) {
            new Datepicker(dpBasicElementEndDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementEndDate.addEventListener('changeDate', function (event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-end-date', { value: formattedDate })
            });
        }

    });
</script>
@endscript
