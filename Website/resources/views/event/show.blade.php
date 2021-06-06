@extends('layouts.app')

@section('content')
    <div class="container">

        @include('event.display_single')

        <a class="btn btn-primary mt-2" href="/{{ $user->id }}/events/{{ $event->id }}/edit">Change event info</a>
    </div>
@endsection
