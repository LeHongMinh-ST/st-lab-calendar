@php
    use App\Common\Constants;
@endphp
<x-main-layout>
    <div class="content seminar">

        <!-- Basic view -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 text-uppercase">CÁC SỰ KIỆN SẮP DIỄN RA</h4>
            </div>

            <div class="card-body">
                <x-seminar-section :events="$seminars" :new="true"></x-seminar-section>
            </div>
        </div>
        <!-- /basic view -->

        <!-- Basic view -->
        <div class="card">
            <div class="card-header d-md-flex align-items-center justify-content-between">
                <h4 class="mb-0 text-uppercase">Các hoạt động đã diễn ra</h4>
                <form action="" class="filter-seminar" id="frm-filter-seminar">
                    <div class="form-group">
                        <select name="year" id="filter-select-year" class="form-select">
                            <option value="" @if(request()->query('year') == '') selected @endif>Tất cả</option>
                            @foreach(Constants::YEAR as $year)
                                <option value="{{ $year }}"
                                        @if(request()->query('year') == $year) selected @endif>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <x-seminar-section :events="$seminarOthers" :new="false"></x-seminar-section>
                @if($pageLimit < $totalPage)
                    @php
                        $newPage = $pageLimit + 1;
                    @endphp
                    <div class="text-center mt-3"><a
                            href="{{ route('activities',['page' => $newPage, ...request()->only('year')]) }}">Xem
                            thêm</a></div>
                @endif
            </div>
        </div>
        <!-- /basic view -->
    </div>
</x-main-layout>
