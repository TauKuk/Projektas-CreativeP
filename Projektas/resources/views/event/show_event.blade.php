<div class="border-top border-dark mt-3" id="event_box">

    <div id="image">
        <img src="/storage/{{ $event->picture ?? $default_picture }}" class="ml-3 mb-3 border border-dark" style="height: 7em; max-width: fit-content;">
    </div>

    <div id="info">
        <div id="title_date">
            <div id="title">
            {{ $event->title }} 
            </div>
            
            <div id="date">{{ $event->start_date }} - {{ $event->end_date }}</div>
        </div>

        <p id="description">{{ $event->description }}  </p>
    </div>
</div>