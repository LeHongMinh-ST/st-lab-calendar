<div class="card card-body">
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="#js-tab1" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                Tài khoản
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a href="#js-tab2" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
                Đổi mật khẩu
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="js-tab1" role="tabpanel">
            <div class="row">
                <div class="col-6">
                    <label class="col-form-label col-lg-3">Ảnh đại diện</label>
                    <input wire:model.live="avatar" type="file" class="form-control" accept="image/*">
                </div>
            </div>
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
                    <label for="full_name" class="col-form-label">
                        Họ và tên <span class="required">*</span>
                    </label>
                    <div class="input-group">
                        <input wire:model.live="full_name" type="text" id="full_name"
                               class="form-control">
                    </div>
                    @error('full_name')
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
                <div class="row mt-3">
                    <div class="col-6">
                        <button type="submit" wire:click="updateInfo" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="js-tab2" role="tabpanel">
            <div class="row">
                <div class="col-6">
                    <label for="old_password" class="col-form-label">
                        Mật khẩu cũ <span class="required">*</span>
                    </label>
                    <input wire:model.live="old_password" type="password" id="old_password" class="form-control">
                    @error('old_password')
                    <label id="error-username" class="validation-error-label text-danger"
                           for="username">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="new_password" class="col-form-label">
                        Mật khẩu mới <span class="required">*</span>
                    </label>
                    <input wire:model.live="new_password" type="password" id="new_password" class="form-control">
                    @error('new_password')
                    <label id="error-username" class="validation-error-label text-danger"
                           for="username">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label for="retyped_password" class="col-form-label">
                        Xác nhận mật khẩu mới <span class="required">*</span>
                    </label>
                    <input wire:model.live="retyped_password" type="password" id="retyped_password"
                           class="form-control">
                    @error('retyped_password')
                    <label id="error-username" class="validation-error-label text-danger"
                           for="username">{{ $message }}</label>
                    @enderror
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <button type="submit" wire:click="updatePassword" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
