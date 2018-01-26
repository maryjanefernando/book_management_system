<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function book_site() {
        return $this->belongsTo('App\BookSite', 'site_id');
    }

    public function getIdAttribute($value) {
        return str_pad($value, 10, 0, STR_PAD_LEFT);
    }

}
