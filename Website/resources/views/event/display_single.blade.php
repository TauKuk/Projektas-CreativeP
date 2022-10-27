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
                
                <div class="date">
                    <!-- substr naudojam kad nuimt minutes, valandas ir sekundes -->

                    <!-- Tikrina ar sutampa diena -->
                    @if(substr($event->start_date, 0, -8) == substr($event->end_date, 0, -8))
                        {{ substr($event->start_date, 0, -3) }}-{{ substr($event->end_date, 11, -3) }}

                    @else
                        {{ substr($event->start_date, 0, -3) }} 

                        @if($event->end_date && $event->start_date != $event->end_date)
                            - {{ substr($event->end_date, 0, -3) }} 
                        @endif
                    @endif
                </div>
            </div>

            <p class="description">
                <div style="white-space: pre-wrap;">{{ $event->description }}</div>
                
                <div class="place-status">
                    <div class="place">
                        @if($event->place) <div>Vieta: {{ $event->place }}</div>@endif 
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
