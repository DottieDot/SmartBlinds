<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room extends Model
{
    use Notifiable;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'name', 'state',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($room) {
            $room->routineActions()->delete();
            $room->systems()->each(function($system) {
                $system->room()->dissociate();
                $system->save();
            });
        });
    }

    public function home() 
    {
        return $this->belongsTo(Home::class);
    }

    public function user()
    {
        return $this->belongsToThrough(User::class, Home::class);
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
        return $this->hasMany(RoutineAction::class);
    }
}
