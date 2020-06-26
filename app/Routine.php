<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Routine extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'trigger_at', 'days',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($room) {
            $room->actions()->delete();
        });
    }

    public function actions() 
    {
        return $this->hasMany(RoutineAction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}