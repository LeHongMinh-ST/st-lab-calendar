<div class="row">
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
                    <div class="col-12 col-md-6">
                        <label for="title" class="col-form-label">
                            Ngày bắt đầu <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model="startDate" type="text" id="startDate"
                                   class="form-control datepicker-basic datepicker-input">
                        </div>
                        @error('startDate')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror

                    </div>
                    <div class="col-12 col-md-6">
                        <label for="title" class="col-form-label">
                            Ngày kết kúc <span class="required">*</span>
                        </label>
                        <div class="input-group">
                           <span class="input-group-text">
												<i class="ph-calendar"></i>
											</span>
                            <input wire:model.live="endDate" type="text" id="endDate"
                                   class="form-control datepicker-basic datepicker-input">
                        </div>
                        @error('endDate')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="title" class="col-form-label">
                            Thời gian <span class="required">*</span>
                        </label>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <input type="time" class="form-control" wire:model.live="startTime">
                            </div>
                            <div class="col-md-1 col-12 d-none d-md-flex align-items-center justify-content-center">
                                <div class="tilde d-flex align-items-center justify-content-center">~</div>
                            </div>
                            <div class="col-md-3 col-12">
                                <input type="time" class="form-control" wire:model.live="endTime">
                            </div>
                            @if($this->totalTime)
                                <div class="col-md-4 col-12 d-flex align-items-center">
                                    ({{$this->totalTime}})
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="title" class="col-form-label">
                            Lặp lại
                        </label>
                        <select type="text" id="title" class="form-select">
                            <option value="">Không lặp lại</option>
                            <option value="">Lặp lại hàng tuần</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header bold">
                <i class="ph-users-three"></i>
                Nhóm - Hoạt động
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <label for="title" class="col-form-label">
                                Nhóm<span class="required">*</span>
                            </label>
                            <input type="text" id="title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <label for="title" class="col-form-label">
                                Hoạt động<span class="required">*</span>
                            </label>
                            <input type="text" id="title" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex align-items-center gap-1">
                <button class="btn btn-primary" @click="$wire.submit"><i class="ph-floppy-disk"></i> Lưu</button>
                <button class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</button>
            </div>
        </div>
    </div>
</div>

@script
<script>
    $(document).ready(function () {
        const dpBasicElementStartDate = document.querySelector('#startDate');
        if(dpBasicElementStartDate) {
            const dpClearStart = new Datepicker(dpBasicElementStartDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                clearBtn: true,
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementStartDate.addEventListener('changeDate', function(event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-start-date', { value: formattedDate})
            });
        }


        const dpBasicElementEndDate = document.querySelector('#endDate');
        if(dpBasicElementStartDate) {
            const dpClearEnd = new Datepicker(dpBasicElementEndDate, {
                container: '.content-inner',
                buttonClass: 'btn',
                prevArrow: document.dir == 'rtl' ? '&rarr;' : '&larr;',
                nextArrow: document.dir == 'rtl' ? '&larr;' : '&rarr;',
                clearBtn: true,
                format: 'dd/mm/yyyy',
                weekStart: 1,
                language: 'vi',
            });
            dpBasicElementEndDate.addEventListener('changeDate', function(event) {
                const selectedDate = new Date(event.detail.date);
                const formattedDate = formatDateToString(selectedDate);
                Livewire.dispatch('update-end-date', { value: formattedDate})
            });
        }

    });
</script>
@endscript
