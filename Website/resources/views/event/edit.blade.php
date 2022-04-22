@extends('layouts.app')

@section('content')
    @if ($user->id == Auth::user()->id && $user->id == $event->user_id)
    <main> 
        <div class="container">
            <h1>Redaguoti {{ $event->title }}</h1>

            <div class="event-form">
                <form action="/{{ $user->id }}/events/{{ $event->id }}" enctype="multipart/form-data" method="post" id="update_form">

                    @method('PUT')

                    <div class="form-group">
                        <label class="font-weight-bold" for="title">Renginio pavadinimas</label>
                        <input type="text" name="title" class="form-control" autocomplete="off" placeholder="Įvesktie renginio pavadinimą" maxlength="30" value="{{ old('title') ?? $event->title }}">
                        @error('title') <div class="error"><p>{{ $message }}</p></div> @enderror
                    </div>

                    @include("place_picker", ["form" => "update_form"])
                    
                    <div class="form-group">
                        <label class="font-weight-bold" for="start_date">Renginio pradžios data</label>
                        <input type="datetime-local" class="form-control" name="start_date" value="{{ old('start_date') ?? $start_date }}" >
                        @error('start_date') <div class="error"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="end_date">Renginio pabaigos data</label>
                        <input type="datetime-local" name="end_date" class="form-control" autocomplete="off" value="{{ old('end_date') ?? $end_date }}">
                        @error('end_date') <div class="error"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="description">Renginio aprašymas</label>
                        <textarea name="description" class="form-control" autocomplete="off" maxlength="255" placeholder="Įvesktie renginio aprašymą" style="min-height: 4em; max-height: 10em;">{{old('description') ?? $event->description}}</textarea>
                        @error('description') <div class="error"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="picture">Renginio nuotrauka</label>
                        <input type="file" name="picture" class="form-control-file" style="height: 10;" autocomplete="off" style="height:5em;">
                        @error('picture') <div class="error"><p>{{ $message }}</p></div> @enderror
                    </div>

                    @csrf

                    <button class="btn btn-primary">Patvirtinti</button>
                    <button form="deleteForm" class="btn btn-dark">Ištrinti renginį</button> 
        
                    </form>
        
                    <form id="deleteForm" action="/{{ $user->id }}/events/{{ $event->id }}" method="post">
        
                        @method('DELETE')
                        @csrf
                        
                    </form>
            </div>

        </div>
    </main>

        
    @endif
   
@endsection
