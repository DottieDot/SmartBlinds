<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function homes() {
        return $this->hasMany(Home::class);
    }

    public function systems() {
        return $this->hasMany(System::class);
    }

    public function routines() {
        return $this->hasMany(Routine::class);
    }
}
