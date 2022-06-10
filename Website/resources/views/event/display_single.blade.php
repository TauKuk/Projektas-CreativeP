<div class="event-wrapper">
    <div class="event_box" style="overflow: auto;">

        <!-- <div class="dragging">
            <div class="drag-line">
            </div>

            <div class="drag-line">
            </div>
        </div> -->
        
        @if($event->PictureExists())
        <div class="image">
            <img src='{{ $event->ShowPicture() }}' class="border border-dark">
        </div>
        @endif

        <div class="info">
            <div class="title_date">
                <div class="title">
                {{ $event->title }}
                </div>
                
                <div class="date">{{ $event->start_date }} 
                    @if($event->start_date != $event->end_date)
                        - {{ $event->end_date }}</div>
                    @endif
            </div>

            <p class="description">
                <div style="white-space: pre-wrap;">{{ $event->description }}</div>
                
                <div class="place-status">
                    <div class="place">
                        @if($event->country) <div>Šalis: {{ $event->country }}</div>@endif 
                        @if($event->city) <div>Miestas: {{ $event->city }}</div> @endif 
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
