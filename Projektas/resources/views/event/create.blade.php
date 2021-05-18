@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create event</h1>

        <div style="width: 40%;">
            <form action="/{{ $user->id }}/events" enctype="multipart/form-data" method="post" id="create_form">

                <div class="form-group">
                    <label class="font-weight-bold" for="title">Event`s title</label>
                    <input type="text" name="title" class="form-control" autocomplete="off" placeholder="Enter the event`s title" value="{{ old('title') }}">
                    @error('title') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                @include("place_picker", ["form" => "create_form"])

                <div class="form-group">
                    <label class="font-weight-bold" for="start_date">Event`s start date</label>
                    <input type="datetime-local" name="start_date" class="form-control" autocomplete="off" min="{{ $current_date }}" value="{{ old('start_date') }}">
                    @error('start_date') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="end_date">Event`s end date</label>
                    <input type="datetime-local" name="end_date" class="form-control" autocomplete="off" min="{{ $current_date }}" value="{{ old('end_date') }}">
                    @error('end_date') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="description">Event`s description</label>
                    <textarea name="description" class="form-control" autocomplete="off" placeholder="Enter the event`s description" style="min-height: 4em; max-height: 10em; max-width: 60ch;"></textarea>
                    @error('description') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="picture">Event`s picture</label>
                    <input type="file" name="picture" class="form-control-file" style="height: 10;"autocomplete="off" style="height:5em;">
                    @error('picture') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                @csrf
                <button class="btn btn-primary">Submit</button>

            </form>
        </div>  
    </div>
@endsection
