<div class="seminar-item">
    <div class="date_stamp">
        <div class="date_stamp_top">
            <div class="weekday">{{ $dayOfWeek }}</div>
            <div class="event_date">{{ $date }}</div>
        </div>
        <p class="date_time_bottom">{{ $monthYear }}</p>
    </div>
    <div class="seminar_item_right">
        <div class="article-title"><a href="">{{ $event?->activity?->title }}</a> @if($new) <span class="badge bg-danger">Sắp diễn ra</span> @endif
        </div>
        <div class="seminar_info">
            <div><i>Bắt đầu:</i> {{ $time }}</div>
            <div><i>Địa điểm:</i> Phòng Lab 105</div>
            <div><i>Nhóm:</i> {{$event?->team?->name}}</div>
            <div><i>Người thuyết trình:</i> {{$event?->activity?->owner}}</div>
        </div>
    </div>
</div>
