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

        return response()->json($users);
    }

    public function image($picture) {
        return view('upload_image', compact("picture"));
    }
}
