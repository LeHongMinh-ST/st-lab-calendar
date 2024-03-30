<x-admin-layout>
    <x-slot name="header">
        <div class="page-header page-header-light shadow">
            <div class="page-header-content d-lg-flex">
                <div class="d-flex">
                    <h4 class="page-title mb-0">
                        Nhóm - <span class="fw-normal">Tạo mới nhóm</span>
                    </h4>
                </div>

            </div>

            <div class="page-header-content d-lg-flex border-top">
                <div class="d-flex">
                    <div class="breadcrumb py-2">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="ph-house"></i></a>
                        <a href="#" class="breadcrumb-item">Nhóm</a>
                        <span class="breadcrumb-item active">Tạo mới nhóm</span>
                    </div>

                    <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                    </a>
                </div>

            </div>
        </div>
    </x-slot>
    <div class="content">
        <form>
           <div class="row">
               <div class="col-md-9 col-12">
                   <div class="card">
                       <div class="card-header bold">
                           <i class="ph-plus-circle"></i>
                           <b>Tạo mới</b>
                       </div>
                       <div class="card-body">
                           <div class="mb-3">
                               <label class="col-form-label">
                                   Tên nhóm
                                   <span class="required">*</span>
                               </label>
                               <input type="text" class="form-control" placeholder="Nhập tên nhóm...">
                           </div>
{{--                           <div class="mb-3">--}}
{{--                               <label for="title" class="col-form-label">--}}
{{--                                   Màu <span class="required">*</span>--}}
{{--                               </label>--}}
{{--                               <!-- Markup example -->--}}
{{--                               <input type="text" class="form-control colorpicker-basic" value="#20BF7E">--}}
{{--                           </div>--}}
                           <div class="mb-3">
                               <label for="title" class="col-form-label">
                                   Mô tả <span class="required">*</span>
                               </label>
                               <textarea class="form-control" id="ckeditor_classic_empty" placeholder="Enter your text..."></textarea>
                           </div>
                           <div class="mb-3">
                               <label for="title" class="col-form-label">
                                   Trạng thái <span class="required">*</span>
                               </label>
                               <div class="col-lg-3 form-check form-switch mb-2">
                                   <input type="checkbox" class="form-check-input" id="sc_ls_c" checked>
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
                           <button class="btn btn-primary"><i class="ph-floppy-disk"></i> Lưu</button>
                           <a href="#" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
                       </div>
                   </div>
               </div>
           </div>
        </form>
    </div>

</x-admin-layout>
