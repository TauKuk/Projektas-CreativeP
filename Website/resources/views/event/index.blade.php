@extends('layouts.app')

@section('content')

    @if ($user->id == Auth::user()->id)
    <main> 
      <div class="container">
            <div class="row">
                <div class="col-md-6 flex-shrink-1"><h1>Renginiai, sukurti {{ $user->name }}</h1></div>

                <div class="col-md-6 d-flex justify-content-end flex-shrink-1" class="mb-0">
                    <a href="/{{ $user->id }}/events/create"><h1>Sukurti renginį</h1></a>
                </div>
            </div>

            @forelse($events as $index => $event)

            <a href="/{{ $user->id }}/events/{{ $event->id }}" id="link">
                @include('event.display_single')
            </a>

            @empty

            <p class="border-top border-dark pt-3 mb-3">Nėra sukurtų renginių</p>

            @endforelse
        </div>  
    </main>
    
    @endif
@endsection
