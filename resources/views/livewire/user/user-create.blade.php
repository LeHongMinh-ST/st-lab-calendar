<div class="row">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin người dùng
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label for="username" class="col-form-label">
                            Tên tài khoản <span class="required">*</span>
                        </label>
                        <input wire:model.live="username" type="text" id="username" class="form-control">
                        @error('username')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="email" class="col-form-label">
                            Email <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <input wire:model.live="email" type="text" id="email"
                                   class="form-control">
                        </div>
                        @error('email')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="password" class="col-form-label">
                            Mật khẩu <span class="required">*</span>
                        </label>
                        <input wire:model.live="password" type="password" id="password" class="form-control">
                        @error('password')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="phone_number" class="col-form-label">
                            Số điện thoại <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <input wire:model.live="phone_number" type="text" id="phone_number"
                                   class="form-control">
                        </div>
                        @error('phone_number')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-16">
                        <label for="full_name" class="col-form-label">
                            Họ và tên <span class="required">*</span>
                        </label>
                        <input wire:model.live="full_name" type="text" id="full_name" class="form-control">
                        @error('full_name')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="role" class="col-form-label">
                            Vai trò <span class="required">*</span>
                        </label>
                        <select id="selectRole" class="form-control select" wire:model.live="role">
                            <option value="" disabled>Chọn vai trò ...</option>
                            @foreach($roles as $value => $name)
                                <option value="{{$value}}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="status" class="col-form-label">
                            Trạng thái <span class="required">*</span>
                        </label>
                        <select id="selectStatus" class="form-select" wire:model.live="status">
                            <option value="" disabled>Chọn trạng thái ...</option>
                            @foreach($statuses as $value => $name)
                                <option value="{{$value}}">{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('status')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
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
                <a href="{{route('admin.users.index')}}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>
