@extends('layouts.app')

@section('content')
    @if ($user->id == Auth::user()->id && $user->id == $event->user_id)
    <main> 
        <div class="container" style="padding-top: 0.1em;">

            @include('event.display_single')

            <a style="margin-left: 0.9em;" class="btn btn-primary mt-2" style="" href="/{{ $user->id }}/events/{{ $event->id }}/edit">Redaguoti renginį</a>
        </div>
    </main>    
    @endif
    
@endsection
