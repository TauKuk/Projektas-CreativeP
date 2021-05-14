@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Create event</h1>

        <div>
            <form action="/{{ $user->id }}/events" enctype="multipart/form-data" method="post">

                <div class="form-group">
                    <label class="font-weight-bold" for="title">Event`s title</label>
                    <input type="text" name="title" class="form-control" autocomplete="off" placeholder="Enter the event`s title" style="width: 40%;">
                    @error('title') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="place">Event`s place</label>
                    <input type="text" name="place" id="autocomplete" class="form-control" autocomplete="off" placeholder="Enter the event`s place" style="width: 40%;">
                    @error('place') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="start_date">Event`s start date</label>
                    <input type="datetime-local" name="start_date" class="form-control" autocomplete="off" min="{{ $current_date }}">
                    @error('start_date') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="end_date">Event`s end date</label>
                    <input type="datetime-local" name="end_date" class="form-control" autocomplete="off" min="{{ $current_date }}">
                    @error('end_date') <div class="font-weight-bold" style="color:red"><p>{{ $message }}</p></div> @enderror
                </div>

                <div class="form-group">
                    <label class="font-weight-bold" for="description">Event`s description</label>
                    <textarea name="description" class="form-control" autocomplete="off" placeholder="Enter the event`s description" style="min-height: 4em; max-height: 15em;"></textarea>
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
