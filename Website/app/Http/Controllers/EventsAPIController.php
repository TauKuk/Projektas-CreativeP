<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventsAPIController extends Controller
{
    public function index_events() {
        $events = Event::all();

        return response()->json($events);
    }

    public function index_users() {
        $users = User::all();

        $usersData = [];

        foreach ($users as $user)
        {
            $usersData[] = (object) array("id" => $user->id, "name" => $user->name);
        }

        return response()->json($usersData);
    }

    public function image($picture) {
        return view('upload_image', compact("picture"));
    }
}
