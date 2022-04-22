@extends('layouts.app')

@section('content')
    @if ($user->id == Auth::user()->id)
    <main> 
        <div class = "container">
            <h1>
                Vartotojo duomenys
            </h1>

            <div>
                <strong>Vartotojo vardas</strong>
                <p>{{$user->name}}</p>
            </div>
            
            <div>
                <strong>El. paštas</strong>
                <p>{{$user->email}}</p>
            </div>
        
            <a class = "button mt-4" href="/users/{{$user->id}}/edit">Redaguoti vartotojo duomenis</a>

        </div>
    </main>

    @endif
@endsection