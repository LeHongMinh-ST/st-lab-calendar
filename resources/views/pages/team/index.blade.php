<x-admin-layout>
    <x-slot name="header">
        <div class="page-header page-header-light shadow">
            <div class="page-header-content d-lg-flex">
                <div class="d-flex">
                    <h4 class="page-title mb-0">
                        Nhóm - <span class="fw-normal">Danh sách nhóm</span>
                    </h4>
                </div>

            </div>

            <div class="page-header-content d-lg-flex border-top">
                <div class="d-flex">
                    <div class="breadcrumb py-2">
                        <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="ph-house"></i></a>
                        <a href="#" class="breadcrumb-item">Nhóm</a>
                        <span class="breadcrumb-item active">Danh sách nhóm</span>
                    </div>

                    <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                    </a>
                </div>

            </div>
        </div>
    </x-slot>
    <div class="content">
        <div class="row">
            <div class="col-md-9 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="search" class="form-control" placeholder="Search">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-magnifying-glass text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5"></div>
                            <div class="col-lg-2">
                                <a href="#" class="btn btn-success"><i class="ph-plus-circle"></i>Tạo mới</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-border-solid">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên nhóm</th>
                                    <th>Màu sắc</th>
                                    <th>Mô tả</th>
                                    <th>Trưởng nhóm</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="badge bg-danger bg-opacity-20 text-danger">Inactive</span></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><span class="badge bg-success bg-opacity-20 text-success">Active</span></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="pagination">

                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
</x-admin-layout>
