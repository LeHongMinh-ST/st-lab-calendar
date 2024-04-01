<x-admin-layout>
    <x-slot name="custom_js">
        @vite(['resources/js/user/index.js'])
    </x-slot>
    <x-slot name="header">
        <div class="page-header page-header-light shadow">
            <div class="page-header-content d-lg-flex">
                <div class="d-flex">
                    <h4 class="page-title mb-0">
                        Lịch - <span class="fw-normal">Chi tiết lịch</span>
                    </h4>

                    <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                    </a>
                </div>
            </div>
            <div class="page-header-content d-lg-flex border-top">
                <div class="d-flex">
                    <div class="breadcrumb py-2">
                        <a href="{{route('admin.dashboard')}}" class="breadcrumb-item"><i class="ph-house"></i></a>
                        <a href="{{route('admin.calendar.index')}}" class="breadcrumb-item">Lịch</a>
                        <span class="breadcrumb-item active">Chi tiết lịch</span>
                    </div>
                    <a href="#breadcrumb_elements" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
                        <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>


    <div class="content">
        <livewire:calendar.calendar-detail :calendarId="$id"/>
    </div>
</x-admin-layout>
