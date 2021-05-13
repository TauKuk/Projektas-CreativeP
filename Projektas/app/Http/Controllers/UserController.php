<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(User $user)
    {
        $user->update($this->validateData());

        return view('user.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/');
    }

    private function validateData()
    {
        $id = Auth::user()->id;

        return request()->validate([
            'name' => ['required', 'string', 'max:30', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id]
        ]);
    }
}


