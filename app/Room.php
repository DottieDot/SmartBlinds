<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
    ];

    public function home() 
    {
        return $this->belongsTo(Home::class);
    }

    public function systems()
    {
        return $this->hasMany(System::class);
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class, 'room_routine_pivot', 'room_id', 'routine_id');
    }
}
