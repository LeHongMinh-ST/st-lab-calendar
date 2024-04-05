<div class="seminar-section">
    <div class="seminar-list">
        @forelse($events as $event)
            <x-seminar-item :event="$event" :new="$new"/>
        @empty
            <div class="empty-calendar text-center">
                <img src="{{asset('assets/images/empty-calendar.png') }}" alt="empty">
                <div class="text-center mb-4">Không có sự kiện nào! </div>
            </div>
        @endforelse
    </div>
</div>
