<div class="row">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-info"></i>
                Thông tin nhóm
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <label for="name" class="col-form-label">
                            Tên nhóm <span class="required">*</span>
                        </label>

                        <input wire:model.live="username" type="text" id="name" class="form-control">
                        @error('username')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="description" class="col-form-label">
                            Mô tả <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <textarea wire:model.live="email" type="text" id="description"
                                      class="form-control textarea"></textarea>
                        </div>
                        @error('email')
                        <label id="error-username" class="validation-error-label text-danger"
                               for="username">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
                <div class="rơ">
                    <div class="col-12">
                        <label for="thumbnail" class="col-form-label">
                            Hình ảnh <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="" id="">
                        </div>
                        @error('thumbnail')
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
