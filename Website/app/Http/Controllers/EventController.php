<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    private function cmp($a, $b)
    {
        if ($a->start_date == $b->start_date) {
            return 0;
        }
        
        if (($a->status->color == "green" && $b->status->color == "blue") ||
            ($a->status->color == "green" && $b->status->color == "red")  ||
            ($a->status->color == "blue" && $b->status->color == "red")) 
            return -1;

        if (($a->status->color == "blue" && $b->status->color == "green") ||
            ($a->status->color == "red" && $b->status->color == "green")  ||
            ($a->status->color == "red" && $b->status->color == "blue")) 
            return 1;
        
        if ($a->status->color == $b->status->color) {
            if ($a->status->color == "red")
               return ($a->end_date > $b->end_date) ? -1 : 1;
            else                                                                        
               return ($a->start_date < $b->start_date) ? -1 : 1;
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $events = auth()->user()->event;

        $eventStatus = [];

        //Sukuria eventu status
        foreach($events as $event) {
            if (strtotime($event->start_date) > strtotime("now + 3 hours"))
            $event->status = (object) array("color" => "blue", "text" => "Renginys neprasidėjo", "image" => "/img/blue_circle.png"); 

            else if (strtotime($event->start_date) <= strtotime("now + 3 hours") && strtotime($event->end_date) >= strtotime("now + 3 hours"))
            $event->status = (object) array("color" => "green", "text" => "Renginys vyksta šiuo metu", "image" => "/img/green_circle.png"); 

            else 
            $event->status = (object) array("color" => "red", "text" => "Renginys pasibaigęs", "image" => "/img/red_circle.png");  
        }

        //Susortina eventus pagal ju busena
        
        $events = (array) $events;
        //DONT ASK
        $events = $events["\x00*\x00items"];

        usort($events, array($this, 'cmp'));

        return view('event.index', compact('user', 'events'));
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
            $path = '/uploads';
            //Issaugoja nuotrauka i public folderi
            if(!Storage::disk('public_uploads')->put($path, $request->file('picture'))) {
                return false;
            }
            
            $picturePath = "uploads/{$request->file('picture')->hashName()}";
            $picture = Image::make("storage/{$picturePath}")->fit(115, 115);

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
        
        if (strtotime($event->start_date) > strtotime("now + 3 hours"))
        $event->status = (object) array("color" => "blue", "text" => "Renginys neprasidėjo", "image" => "/img/blue_circle.png"); 

        else if (strtotime($event->start_date) <= strtotime("now + 3 hours") && strtotime($event->end_date) >= strtotime("now + 3 hours"))
        $event->status = (object) array("color" => "green", "text" => "Renginys vyksta šiuo metu", "image" => "/img/green_circle.png"); 

        else 
        $event->status = (object) array("color" => "red", "text" => "Renginys pasibaigęs", "image" => "/img/red_circle.png");  

        return view('event.show', compact('event', 'user', 'index'));
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
            $path = '/uploads';
            //Issaugoja nuotrauka i public folderi
            if(!Storage::disk('public_uploads')->put($path, $request->file('picture'))) {
                return false;
            }
            
            $picturePath = "uploads/{$request->file('picture')->hashName()}";
            $picture = Image::make("storage/{$picturePath}")->fit(115, 115);

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
            'title' => ['required', 'string', 'max:100', 'min:1'],            
            'country' => ['string', 'nullable', 'max:100'],
            'city'=> ['string', 'nullable', 'max:100'],
            'start_date' => ['required', 'date'],            
            'end_date' => ['required', 'date', 'after:start_date'],            
            'description' => ['string', 'nullable', 'max:1000'],
            'picture' => ['image', 'nullable', 'max:10240'],
        ]);
    }
}
