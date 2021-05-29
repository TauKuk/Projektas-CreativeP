<div class="border-top border-dark mt-3" id="event_box">

    <div id="image">
        <img src='/storage/{{ $event->picture ?? "uploads/default_picture.png" }}' class="ml-3 mb-3 border border-dark">
    </div>

    <div id="info" class="pl-2">
        <div id="title_date">
            <div id="title">
            {{ $event->title }}
            </div>
            
            <div id="date">{{ $event->start_date }} - {{ $event->end_date }}</div>
        </div>

        <p id="description">
            {{ $event->description }}
            
            <div id="place-status" style="margin-bottom: 0%;">
                <div id="place">
                    <div>Country: {{ $event->country }}</div> 
                    <div>City: {{ $event->city }}</div> 
                </div>  

                <div id="status">
                    <img src="/storage/{{ $eventStatus[$index]->image }}" style="width: 0.9rem;">
                    <span style="color: {{ $eventStatus[$index]->color }};">{{ $eventStatus[$index]->text }}</span> 
                </div>
            </div>
        </p>
    </div>
</div>