<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    protected $appends = ['full_name'];

    public function book_site() {
        return $this->belongsTo('App\BookSite', 'site_id');
    }

    public function getFullNameAttribute() {
        return $this->getAttribute('first_name'). ' ' .$this->getAttribute('last_name');
    }
}
