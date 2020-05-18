<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class System extends Model
{
    use Notifiable;

    protected $fillable = [
        'name', 'state',
    ];

    public function home() 
    {
        return $this->belongsTo(Home::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
