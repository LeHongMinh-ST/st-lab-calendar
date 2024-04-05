<x-main-layout>
    <div class="content seminar">

        <!-- Basic view -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 text-uppercase" >CÁC SỰ KIỆN SẮP DIỄN RA</h4>
            </div>

            <div class="card-body">
              <x-seminar-section :events="$seminars" :new="true"></x-seminar-section>
            </div>
        </div>
        <!-- /basic view -->

        <!-- Basic view -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 text-uppercase">Các hoạt động đã diễn ra</h4>
            </div>

            <div class="card-body">
                <x-seminar-section :events="$seminarOthers" :new="false"></x-seminar-section>
            </div>
        </div>
        <!-- /basic view -->
    </div>
</x-main-layout>
