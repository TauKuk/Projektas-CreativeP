<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

class EventsAPIController extends Controller
{
    public function index_events() {
        $events = Event::where("user_id", "1")->get();

        return response()->json($events);
    }

    public function image($picture) {
        return view('upload_image', compact("picture"));
    }
}
