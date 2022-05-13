<div class="event-wrapper">
    <div class="event_box">

        <div class="image">
            <img src='{{ $event->ShowPicture() }}' class="border border-dark">
        </div>


        <div class="info">
            <div class="title_date">
                <div class="title">
                {{ $event->title }}
                </div>
                
                <div class="date">{{ $event->start_date }} - {{ $event->end_date }}</div>
            </div>

            <p class="description">
                {{ $event->description }}
                
                <div class="place-status">
                    <div class="place">
                        @if($event->country) <div>Country: {{ $event->country }}</div>@endif 
                        @if($event->city) <div>City: {{ $event->city }}</div> @endif 
                    </div>  

                    <div class="status">
                        <img src="{{ $event->status->image }}" style="width: 0.9rem;">
                        <span style="color: {{ $event->status->color }};">{{ $event->status->text }}</span> 
                    </div>
                </div>
            </p>
        </div>
    </div>
</div>
