<x-admin-layout>
    <x-slot name="header">
        <div class="page-header page-header-light shadow">
            <div class="page-header-content d-lg-flex">
                <div class="d-flex">
                    <h4 class="page-title mb-0">
                        Home - <span class="fw-normal">Người dùng</span>
                    </h4>

                    <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                    </a>
                </div>

            </div>
    
            <div class="page-header-content d-lg-flex border-top">
                <div class="d-flex">
                    <div class="breadcrumb py-2">
                        <a href="index.html" class="breadcrumb-item"><i class="ph-house"></i></a>
                        <a href="#" class="breadcrumb-item">Home</a>
                        <span class="breadcrumb-item active">Người dùng</span>
                    </div>

                    <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                    </a>
                </div>

            </div>
        </div>
    </x-slot>


    <div class="content">
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item" role="presentation">
                <a href="#js-tab1" class="nav-link active" data-bs-toggle="tab">
                    <i class="ph-user"></i>
                    User profile
				</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#js-tab2" class="nav-link" data-bs-toggle="tab">
                    <i class="ph-camera"></i>
                    Avatar
				</a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#js-tab3" class="nav-link" data-bs-toggle="tab">
                    <i class="ph-lock"></i>
                    Change password
				</a>
            </li>
        </ul>
        <div class="tab-content" style="background-color:white">
            <div class="tab-pane fade show active" id="js-tab1">
            <form style="padding: 20px;">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">
                                First Name</label>
                                <span class="text-danger">*</span>
                            <input type="text" name="firstname" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Last name
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="lastname" class="form-control" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">
                                Username
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="username" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-lg-6">
                    <div class="mb-3">
                            <label class="form-label">
                                Email
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" class="form-control" value="">
                        </div>
                    </div>
                </div>
                    
                    <hr>
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary"><i class="ph-check-circle"></i>Update</button>
                    </div>
            </form>


            </div>
            <div class="tab-pane fade" id="js-tab2">
            <div class="mb-3" style="padding: 20px;">
            
            <form action="">
                <label class="form-label">Chọn ảnh đại diện:</label>
                <input type="file" class="form-control">
                <div class="form-text text-muted">Tên tệp khả dụng: gif, png, jpg.</div>
                <hr>
                <div class="d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary"><i class="ph-check-circle"></i>Update</button>
                </div>
            </form>

            </div>
            </div>
            <div class="tab-pane fade" id="js-tab3">
            <div class="row" style="padding: 20px;">
            <div class="card-body">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" value="" readonly class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Mật khẩu hiện tại
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" value="" readonly class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Mật khẩu mới
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" placeholder="Enter new password" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    Nhập lại mật khẩu mới
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" placeholder="Repeat new password" class="form-control">
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>