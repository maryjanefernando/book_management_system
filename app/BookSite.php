<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookSite extends Model
{
    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function book_site_type() {
        return $this->belongsTo('App\BookSiteType', 'site_type');
    }

    public function books() {
        return $this->hasMany('App\Book', 'site_id');
    }



}
