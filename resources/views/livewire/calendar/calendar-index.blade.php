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
                    <a href="{{route('admin.calendar.create')}}" type="button" class="btn btn-primary btn-icon px-2">
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
                    <th>TIÊU ĐỀ</th>
                    <th>NHÓM PHỤ TRÁCH</th>
                    <th>NGÀY BẮT ĐẦU</th>
                    <th>NGÀY KẾT THÚC</th>
                    <th>TRẠNG THÁI</th>
                    <th class="text-center">HÀNH ĐỘNG</th>
                </tr>
                </thead>
                <tbody>
                @forelse($calendars as $calendar)
                    <tr>
                        <td class="w-16px">{{ $loop->index + 1 + $calendars->perPage() * ($calendars->currentPage() - 1)   }}</td>
                        <td class="single-line-text">{{ $calendar->title }}</td>
                        <td>{{ $calendar->team->name }}</td>
                        <td>{{ $calendar->start_day}}</td>
                        <td>{{ $calendar->end_day}}</td>
                        <td>{!! $calendar->statusText !!}</td>
                        <td class="text-center">
                            <div class="dropdown ">
                                <a href="#" class="text-body" data-bs-toggle="dropdown">
                                    <i class="ph-list"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{route('admin.users.edit', $calendar->id)}}" class="dropdown-item">
                                        <i class="px-1 ph-note-pencil"></i>
                                        Chỉnh sửa
                                    </a>
                                    <a href="{{route('admin.calendar.show', $calendar->id)}}" class="dropdown-item">
                                        <i class="px-1 ph-eye"></i>
                                        Chỉ tiết
                                    </a>
                                    <a type="button" @click="$wire.openDeleteModal({{ $calendar->id }})" href="#" class="dropdown-item">
                                        <i class="px-1 ph-trash"></i>
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
    {{ $calendars->links('vendor.pagination.theme') }}
</div>
