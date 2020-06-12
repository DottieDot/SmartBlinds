<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Home extends Model
{
    use Notifiable;

    public static function boot() {
        parent::boot();

        static::deleting(function($home) {
            $home->rooms()->delete();
        });
    }

    protected $fillable = [
        'name', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
