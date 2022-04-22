@extends('layouts.app')

@section('content')

    @if ($user->id == Auth::user()->id)
    <main> 
        <div class="container">

            <h1 class="mb-4">Redaguoti vartotojo duomenis</h1>

            <div>
                <form action="/users/{{ $user->id }}" method="post" class="edit-user">
            
                @method('PUT')

                <div class = "mb-2">
                    <div><strong><label for="name">Naujas vartotojo vardas</label></strong></div>
                    <input type="text" name="name" autocomplete="off" value="{{ old('username') ?? $user->name }}">
                    @error('name') <div class="error"><p>{{$message}}</p></div> @enderror 
                </div>
                
                <div class = "mb-2">
                    <div><strong><label for="email">Naujas El. paštas</label></strong></div>
                    <input type="text" name="email" autocomplete="off" value="{{ old('email') ?? $user->email }}">
                    @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
                </div>
                
                <!-- <div class = "mb-2">
                    <div><strong><label for="password">Slaptažodis</label></strong></div>
                    <input type="password" id="password" autocomplete="off" style="color: grey;">
                    @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
                </div>
                    
                <div class = "mb-2">
                    <div><strong><label for="password">Pakartoti slaptažodį</label></strong></div>
                    <input type="password" id="confirm_password" autocomplete="off" style="color: grey;">
                    @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
                </div> -->

                @csrf
                <button class="btn btn-primary">Patvirtinti</button>
                <button form="deleteForm" class="btn btn-dark">Ištrinti vartotoją</button> 

                </form>

                <form id="deleteForm" action="/users/{{ $user->id }}" method="post">

                    @method('DELETE')
                    @csrf
                    
                </form>
            </div>
        </div>
    </main>

       
    @endif
@endsection