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

        <div class="table-responsive-md">
            <table class="table fs-table ">
                <thead>
                <tr class="table-light">
                    <th>STT</th>
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
                        <td>{{ $loop->index + 1 + $users->perPage() * ($users->currentPage() - 1)   }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{!! $user->roleText !!}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>{!! $user->statusText !!}</td>
                        <td class="text-center">
                            <div class="dropdown ">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{route('admin.users.edit', $user->id)}}" class="dropdown-item">
                                        <i class="ph-note-pencil"></i>
                                        Chỉnh sửa
                                    </a>
                                    <a type="button" @click="$wire.openDeleteModal({{ $user->id }})" href="#" class="dropdown-item">
                                        <i class="ph-trash"></i>
                                        Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
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
    {{ $users->links('vendor.pagination.theme') }}
</div>
