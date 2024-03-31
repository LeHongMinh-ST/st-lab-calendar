<div>
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between">
            <div class="d-flex gap-2">
                <div>
                    <input wire:model.live="search" type="text" class="form-control" placeholder="Tìm kiếm...">
                </div>
            </div>
            <div class="d-flex gap-2">
                <div>
                    <a href="{{route('admin.users.create')}}" type="button" class="btn btn-primary btn-icon px-2">
                        <i class="ph-plus-circle px-1"></i><span>Thêm mới</span>
                    </a>
                </div>
                <div>
                    <button type="button" class="btn btn-light btn-icon px-2" @click="$wire.$refresh">
                        <i class="ph-arrows-clockwise px-1"></i><span>Tải lại</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table fs-table ">
                <thead>
                <tr class="table-light">
                    <th>TÊN TÀI KHOẢN</th>
                    <th>EMAIL</th>
                    <th>VAI TRÒ</th>
                    <th>NGÀY TẠO</th>
                    <th>TRẠNG THÁI</th>
                    <th class="text-center">HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{!! $user->roleText !!}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>{!! $user->statusText !!}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">
                                        <i class="ph-file-pdf me-2"></i>
                                        Export to .pdf
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="ph-file-xls me-2"></i>
                                        Export to .csv
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <i class="ph-file-doc me-2"></i>
                                        Export to .doc
                                    </a>
                                </div>
                            </div>
                        </td>
{{--                        <td class="d-flex gap-1 justify-content-center py-1">--}}
{{--                            <button type="button" class="btn btn-primary btn-icon p-lg-1">--}}
{{--                                <i class="ph-note-pencil"></i>--}}
{{--                            </button>--}}
{{--                            <button type="button" class="btn btn-danger btn-icon p-lg-1">--}}
{{--                                <i class="ph-trash"></i>--}}
{{--                            </button>--}}
{{--                        </td>--}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center">
                            <img src="{{ asset('assets\images\empty.png') }}" width="450px" alt="empty">
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
            {{--        <div class="per_page" wire:ignore>--}}

            {{--        </div>--}}
            {{ $users->links('vendor.pagination.theme') }}
            {{--            {{ $users->appends(request()->input())->links() }}--}}
</div>
