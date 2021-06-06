@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="mb-4">Edit user information</h1>

        <div>
            <form action="/users/{{ $user->id }}" method="post">
           
            @method('PUT')

            <div class = "mb-2">
                <label for="name">New name</label>
                <input type="text" name="name" autocomplete="off" value="{{ old('username') ?? $user->name }}">
                @error('name') <div class="error"><p>{{$message}}</p></div> @enderror 
            </div>
            
            <div class = "mb-2">
                <label for="email">New Email</label>
                <input type="text" name="email" autocomplete="off" value="{{ old('email') ?? $user->email }}">
                @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
            </div>
            
            <!--
                <div class = "mb-2">
                    <label for="password">Password</label>
                    <input type="password" id="password" autocomplete="off" style="color: grey;">
                    @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
                </div>
                    
                <div class = "mb-2">
                    <label for="password">Confirm password</label>
                    <input type="password" id="confirm_password" autocomplete="off" style="color: grey;">
                    @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
                </div>
            -->  
            @csrf
            <button class="btn btn-primary">Confirm</button>
            <button form="deleteForm" class="btn btn-dark">Delete profile</button> 

            </form>

            <form id="deleteForm" action="/users/{{ $user->id }}" method="post">

                @method('DELETE')
                @csrf
                
            </form>
        </div>
    </div>

@endsection