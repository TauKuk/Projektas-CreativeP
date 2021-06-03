@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 flex-shrink-1"><h1>Events made by {{ $user->name }}</h1></div>

            <div class="col-md-6 d-flex justify-content-end flex-shrink-1" class="mb-0">
                <a href="/{{ $user->id }}/events/create"><h1>Create event</h1></a>
            </div>
        </div>

        @forelse($events as $index => $event)

        <a href="/{{ $user->id }}/events/{{ $event->id }}" id="link">
            @include('event.display_single')
        </a>

        @empty

        <p class="border-top border-dark pt-3 mb-3">No events currently created</p>

        @endforelse
    </div>
@endsection
