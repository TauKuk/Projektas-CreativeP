@extends('layouts.app')

@section('content')

    <div class = "container">
        <h1>
            User info
        </h1>

        <div>
            <strong>Name</strong>
            <p>{{$user->name}}</p>
        </div>
        
        <div>
            <strong>Email</strong>
            <p>{{$user->email}}</p>
        </div>
    
        <a class = "button mt-4" href="/users/{{$user->id}}/edit">Change user info</a>

    </div>

@endsection