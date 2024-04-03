<div class="seminar-section">
    <div class="seminar-list">
        @foreach($events as $event)
            <x-seminar-item :event="$event" :new="$new"/>
        @endforeach
    </div>
</div>
