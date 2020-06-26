<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoutineAction extends Model
{
    use Notifiable;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'state', 'room_id'
    ];

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function routine() {
        return $this->belongsTo(Routine::class);
    }

    public function user()
    {
        return $this->belongsToThrough(User::class, Routine::class);
    }
}
