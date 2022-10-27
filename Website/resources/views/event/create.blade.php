@extends('layouts.app')

@section('content')
    
    @if ($user->id == Auth::user()->id )
    <main> 
        <div class="container">
            <h1 style="margin-bottom: 0.5em;" class="event-form">Sukurti renginį</h1>
            <div class="event-form">
                <form action="/{{ $user->id }}/events" enctype="multipart/form-data" method="post" id="create_form">

                    <div class="form-group">
                        <label class="font-weight-bold" for="title">Renginio pavadinimas</label>
                        <input type="text" name="title" class="form-control" autocomplete="off" placeholder="Įvesktie renginio pavadinimą" maxlength="100" value="{{ old('title') }}">
                        @error('title') <div class="font-weight-bold" style="color:red;"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="place">Renginio vieta</label>
                        <input type="text" name="place" class="form-control" autocomplete="off" placeholder="Įvesktie renginio vietą" maxlength="100" value="{{ old('place') }}">
                        @error('place') <div class="font-weight-bold" style="color:red;"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="start_date">Renginio pradžios data</label>
                        <input type="datetime-local" name="start_date" class="form-control" autocomplete="off" value="{{ old('start_date') }}">
                        @error('start_date') <div class="font-weight-bold" style="color:red;"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="end_date">Renginio pabaigos data</label>
                        <input type="datetime-local" name="end_date" class="form-control" autocomplete="off" value="{{ old('end_date') }}">
                        @error('end_date') <div class="font-weight-bold" style="color:red;"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="description">Renginio aprašymas</label>
                        <textarea name="description" class="form-control" autocomplete="off" maxlength="1000" placeholder="Įvesktie renginio aprašymą" style="min-height: 4em; max-height: 10em; white-space: pre-wrap;">{{ old('description') }}</textarea>
                        @error('description') <div class="font-weight-bold" style="color:red;"><p>{{ $message }}</p></div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold" for="picture">Renginio nuotrauka</label>
                        <input type="file" name="picture" class="form-control-file" style="height: 10;"autocomplete="off" style="height:5em;">
                        @error('picture') <div class="font-weight-bold" style="color:red;"><p>{{ $message }}</p></div> @enderror
                    </div>

                    @csrf
                    <button class="btn btn-primary">Sukurti</button>

                </form>
            </div>  
        </div>
    </main>
       
    @endif

   
@endsection
