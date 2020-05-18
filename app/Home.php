<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Home extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function systems() 
    {
        return $this->hasMany(System::class);
    }
}
