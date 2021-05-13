@extends('layouts.app')

@section('content')
<div class = "container">
    <div class = "row">
       <table class = "col-4">

        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </thead>

        @forelse($users as $user)

                <tr class = "border">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }} </td>
                    <td>{{ $user->email }} </td>
                </tr>
            @empty

            <p> no users </p>

        @endforelse
        </table> 
    </div>
</div>
@endsection