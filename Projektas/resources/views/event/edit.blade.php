@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit {{ $event->title }}</h1>

        <div>
            <form action="/{{ $user->id }}/events/{{ $event->id }}" enctype="multipart/form-data" method="post">

                @method('PUT')

                <div class="form-group">
                    <label class="font-weight-bold" for="title">Event`s title</label>
                    <input type="text" name="title" class="form-control" autocomplete="off" placeholder="Enter the event`s title" style="width: 40%;" value="{{ old('title') ?? $event->title }}">
                    @error('title') <div class="error"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="place">Event`s place</label>
                    <input type="text" name="place" class="form-control" autocomplete="off" placeholder="Enter the event`s place" style="width: 40%;" value="{{ old('place') ?? $event->place }}">
                    @error('place') <div class="error"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="start_date">Event`s start date</label>
                    <input type="datetime-local" class="form-control" name="start_date" value="{{ old('start_date') ?? $start_date }}" min="{{ $current_date }}">
                    @error('start_date') <div class="error"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="end_date">Event`s end date</label>
                    <input type="datetime-local" name="end_date" class="form-control" autocomplete="off" value="{{ old('end_date') ?? $end_date }}" min="{{ $current_date }}">
                    @error('end_date') <div class="error"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="description">Event`s description</label>
                    <textarea name="description" class="form-control" autocomplete="off" placeholder="Enter the event`s description" style="min-height: 4em; max-height: 15em;">{{old('description') ?? $event->description}}
                    </textarea>
                    @error('description') <div class="error"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="picture">Event`s picture</label>
                    <input type="file" name="picture" class="form-control-file" style="height: 10;"autocomplete="off" style="height:5em;">
                    @error('picture') <div class="error"><p>{{ $message }}</p></div> @enderror
                </div>

                @csrf

                <button class="btn btn-primary">Confirm</button>
                <button form="deleteForm" class="btn btn-dark">Delete profile</button> 
    
                </form>
    
                <form id="deleteForm" action="/{{ $user->id }}/events/{{ $event->id }}" method="post">
    
                    @method('DELETE')
                    @csrf
                    
                </form>
        </div>

    </div>
@endsection
