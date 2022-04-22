@extends('layouts.app')

@section('content')
    @if ($user->id == Auth::user()->id && $user->id == $event->user_id)
    <main> 
        <div class="container">

            @include('event.display_single')

            <a class="btn btn-primary mt-2" href="/{{ $user->id }}/events/{{ $event->id }}/edit">Redaguoti renginį</a>
        </div>
    </main>    
    @endif
    
@endsection
