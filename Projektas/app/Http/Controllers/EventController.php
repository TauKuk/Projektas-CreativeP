<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $events = Event::all();

        $default_picture = "uploads/h64PpximusVddp3kUBJdtMwBLiwqu4lThXverfYe.png";

        return view('event.index', compact('user', 'events', 'default_picture'));
    }

    public function create(User $user)
    {
        $current_date = date("Y-m-d", strtotime( "now" )) . "T" . date(("H:i"), strtotime("now + 3 hours"));
        
        return view('event.create', compact('user', 'current_date'));
    }

    public function store(Request $request)
    {
        $user = Auth::user(); // Pasiimi dabartinį user ir susetini į kintamajį

        // kuri naują Event ir iš request kintamojo pasiimi vertes
        // verčių pavadinimai pareina iš create.blade formos kur yra <input name="title"... etc.
        // ofc turėtum dar tikrinti ar geri values pareina, bet kolkas tiek to

        $data = $this->validateData();

        $picture = $request->file('picture')->store('uploads', 'public');

        $event = auth()->user()->event()->create([
            'title' => $data['title'],
            'place' => $data['place'],
            'start_date' => $data['start_date'], 
            'end_date' => $data['end_date'],
            'description' => $data['description'],
            'picture' => $picture,
        ]);

        /*Event::create(
            $this->validateData()
        );*/

        // jeigu viskas gerai, redirektini į route kurio vardą apsirašai prie routes 'web.php' kur yra
        // Route::get('/{user}/Events', [EventController::class, 'index'])->name('Events.show');
        // matai                ->name('Events.show') ir kaip antrą argumentą passini vartotojo ID
        return redirect()->route('events.index', $user->id);
    }

    public function show(User $user, Event $event)
    {
        $default_picture = "uploads/h64PpximusVddp3kUBJdtMwBLiwqu4lThXverfYe.png";

        return view('event.show', compact('event', 'user', 'default_picture'));
    }

    public function edit(User $user, Event $event)
    {        
        //dd($event->start_date);
        //dd(date(("H:i"), strtotime( $event->start_date )));

        $current_date = date("Y-m-d", strtotime( "now" )) . "T" . date(("H:i"), strtotime("now + 3 hours"));
        $start_date = date("Y-m-d", strtotime( $event->start_date )) . "T" . date(("H:i"), strtotime( $event->start_date ));
        $end_date = date("Y-m-d", strtotime( $event->end_date )) . "T" . date(("H:i"), strtotime( $event->end_date ));

        return view('event.edit', compact('event', 'user', 'end_date', 'start_date', 'current_date'));
    }

    public function update(User $user, Event $event, Request $request)
    {
        $data = $this->validateData();

        $picture = $request->file('picture')->store('uploads', 'public');

        $event->update([
            'title' => $data['title'],
            'place' => $data['place'],
            'start_date' => $data['start_date'], 
            'end_date' => $data['end_date'],
            'description' => $data['description'],
            'picture' => $picture,
        ]);
        
        return redirect()->route('events.index', $user->id);
    }

    public function destroy(User $user, Event $event)
    {
        $event->delete();
    
        return redirect()->route('events.index', $user->id);
    }

    private function validateData()
    {
        return request()->validate([
            'title' => ['required', 'string', 'max:30', 'min:1'],            
            'place' => ['string', 'nullable', 'max:50'], 
            'start_date' => ['required', 'date', 'after:now'],            
            'end_date' => ['required', 'date', 'after:start_date'],            
            'description' => ['string', 'nullable', 'max:255'],
            'picture' => ['image', 'nullable', 'max:10240'],
        ]);
    }
}
