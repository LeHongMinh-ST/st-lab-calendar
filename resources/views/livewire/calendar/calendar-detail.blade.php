<div class="row">
    <div class="col-md-9 col-12">
        <div class="card">
            <div class="card card-body mb-0">
                <h4><span class="px-2">Tiêu đề:</span> {{$calendar?->title}}</h4>
                <p><b class="px-2">Nhóm: </b>{{$calendar?->team->name}}</p>
                <p><b class="px-2">Ngày bắt đầu: </b>{{$calendar?->start_day}} -<b class="px-2">Ngày kết thúc: </b>{{$calendar?->end_day}}</p>
                <p><b class="px-2">Thời gian: </b>{{$calendar?->start_time}} - {{$calendar?->end_time}}</p>
                <p><b class="px-2">Trạng thái: </b>{!!$calendar?->statusText!!}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between">
                <h5>Thời khoá biểu</h5>
            </div>
            <div class="table-responsive-md">
                <table class="table fs-table ">
                    <thead>
                    <tr class="table-light">
                        <th>STT</th>
                        <th>TIÊU ĐỀ</th>
                        <th>NGÀY</th>
                        <th>THỜI GIAN BẮT ĐẦU</th>
                        <th>THỜI GIAN KẾT THÚC</th>
                        <th>HOẠT ĐỘNG</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td class="w-16px">{{ $loop->index + 1 + $events->perPage() * ($events->currentPage() - 1)   }}</td>
                            <td class="single-line-text">{{ $event->title }}</td>
                            <td>{{ $event->day}}</td>
                            <td>{{ $event->start_time}}</td>
                            <td>{{ $event->end_time}}</td>
                            <td>{{ $event->activity->type->description()}}</td>
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
        {{ $events->links('vendor.pagination.theme') }}
    </div>
    <div class="col-md-3 col-12">
        <div class="card">
            <div class="card-header bold">
                <i class="ph-gear-six"></i>
                Hành động
            </div>
            <div class="card-body d-flex align-items-center gap-1">
                <a href="{{route('admin.calendar.index')}}" type="button" class="btn btn-warning"><i class="ph-arrow-counter-clockwise"></i> Trở lại</a>
            </div>
        </div>
    </div>
</div>
