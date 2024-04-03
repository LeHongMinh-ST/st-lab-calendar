<div class="seminar-section">
    <div class="seminar-header">
        <h4 class="seminar-header-title">Lịch tháng 3</h4>
    </div>
    <div class="seminar-list">
        @foreach($events as $event)
            <x-seminar-item :event="$event"/>
        @endforeach
    </div>
</div>
