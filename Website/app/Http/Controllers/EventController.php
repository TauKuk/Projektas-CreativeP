<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    private $default_picture = "uploads/default_picture.png";

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $events = auth()->user()->event;

        $eventStatus = [];

        //Sukuria eventu Status objekta
        foreach($events as $event) 
            $eventStatus[] = $event->CreateEventStatus($event->start_date, $event->end_date);

        //Susortina eventus pagal pradzios data
        $events = $events->sortBy('start_date');

        return view('event.index', compact('user', 'events', 'eventStatus'));
    }

    public function create(User $user)
    {
        $current_date = date("Y-m-d", strtotime( "now" )) . "T" . date(("H:i"), strtotime("now + 3 hours"));
        
        return view('event.create', compact('user', 'current_date'));
    }

    public function store(User $user, Event $event, Request $request)
    {
        $user = Auth::user(); // Pasiimi dabartinį user ir susetini į kintamajį

        // kuri naują Event ir iš request kintamojo pasiimi vertes
        // verčių pavadinimai pareina iš create.blade formos kur yra <input name="title"... etc.
        // ofc turėtum dar tikrinti ar geri values pareina, bet kolkas tiek to

        $data = $this->validateData();

        // Jei neranda ivestos salies, jos reiksme nustato null
        if (!array_key_exists("country", $data))
        {
            $countryNull = array("country" => null);
            $data = array_merge($data, $countryNull);
        }  

        // Jei neranda ivesto miesto, jo reiksme nustato null
        if (!array_key_exists("city", $data))
        {
            $cityNull = array("city" => null);
            $data = array_merge($data, $cityNull);
        }  

        if (request()->has('picture'))
        {
            $picturePath = $request->file('picture')->store('uploads', 'public');        

            $picture = Image::make(public_path("storage/{$picturePath}"))->fit(115, 115);
            $picture->save();
        }

        else $picturePath = null;

        $event = auth()->user()->event()->create([
            'title' => $data['title'],
            'country' => $data['country'],
            'city' => $data['city'],
            'start_date' => $data['start_date'], 
            'end_date' => $data['end_date'],
            'description' => $data['description'],
            'picture' => $picturePath,
        ]);

        // jeigu viskas gerai, redirektini į route kurio vardą apsirašai prie routes 'web.php' kur yra
        // Route::get('/{user}/Events', [EventController::class, 'index'])->name('Events.show');
        // matai                ->name('Events.show') ir kaip antrą argumentą passini vartotojo ID
        return redirect()->route('events.index', $user->id);
    }

    public function show(User $user, Event $event)
    {
        $index = 0;
        $eventStatus[] = $event->CreateEventStatus($event->start_date, $event->end_date);

        return view('event.show', compact('event', 'user', 'eventStatus', 'index'));
    }

    public function edit(User $user, Event $event)
    {        
        $current_date = date("Y-m-d", strtotime( "now" )) . "T" . date(("H:i"), strtotime("now + 3 hours"));
        $start_date = date("Y-m-d", strtotime( $event->start_date )) . "T" . date(("H:i"), strtotime( $event->start_date ));
        $end_date = date("Y-m-d", strtotime( $event->end_date )) . "T" . date(("H:i"), strtotime( $event->end_date ));

        return view('event.edit', compact('event', 'user', 'end_date', 'start_date', 'current_date'));
    }

    public function update(User $user, Event $event, Request $request)
    {
        $data = $this->validateData();

        // Jei neranda ivestos salies, jos reiksme nustato null
        if (!array_key_exists("country", $data))
        {
            $countryNull = array("country" => null);
            $data = array_merge($data, $countryNull);
        }  

        // Jei neranda ivesto miesto, jo reiksme nustato null
        if (!array_key_exists("city", $data))
        {
            $cityNull = array("city" => null);
            $data = array_merge($data, $cityNull);
        }  

        if (request()->has('picture'))
        {
            $picturePath = $request->file('picture')->store('uploads', 'public');    
                
            $picture = Image::make(public_path("storage/{$picturePath}"))->fit(115, 115);
            $picture->save(); 
        }

        else if ($event->picture) $picturePath = $event->picture; 

        else $picturePath = null;

        $event->update([
            'title' => $data['title'],
            'country' => $data['country'],
            'city' => $data['city'],
            'start_date' => $data['start_date'], 
            'end_date' => $data['end_date'],
            'description' => $data['description'],
            'picture' => $picturePath,
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
            'country' => ['string', 'nullable', 'max:50'],
            'city'=> ['string', 'nullable', 'max:50'],
            'start_date' => ['required', 'date', 'after:now'],            
            'end_date' => ['required', 'date', 'after:start_date'],            
            'description' => ['string', 'nullable', 'max:255'],
            'picture' => ['image', 'nullable', 'max:10240'],
        ]);
    }
}
