<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoutineAction extends Model
{
    use Notifiable;

    protected $fillable = [
        'state',
    ];

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function routine() {
        return $this->belongsTo(Routine::class);
    }
}
