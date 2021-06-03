<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function CreateEventStatus($start_date, $end_date)
    {
        if (strtotime($start_date) > strtotime("now + 3 hours"))
            $status = (object) array("color" => "blue", "text" => "Event has not started", "image" => "/img/blue_circle.png"); 

        else if (strtotime($start_date) <= strtotime("now + 3 hours") && strtotime($end_date) >= strtotime("now + 3 hours"))
            $status = (object) array("color" => "green", "text" => "Event is ongoing", "image" => "/img/green_circle.png"); 

        else 
            $status = (object) array("color" => "red", "text" => "Event has ended", "image" => "/img/red_circle.png");  
        
        return $status;
    }

    public function ShowPicture()
    {
        return ($this->picture)? "/storage/$this->picture" : "/img/default_picture.png";
    }
}
