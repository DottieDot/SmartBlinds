<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'state',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($room) {
            $room->routineActions()->delete();
            $room->systems->dissociate();
        });
    }

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
        return $this->belongsToMany(Routine::class, 'routine_actions', 'room_id', 'routine_id');
    }

    public function routineActions()
    {
        return $this->hasMnay(RoutineAction::class);
    }
}
