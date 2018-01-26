<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    protected $appends = ['place_of_transaction'];

    public function employee() {
        return $this->belongsTo('App\User', 'employee_id');
    }

    public function customer() {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function book() {
        return $this->belongsTo('App\Book', 'book_id');
    }

    public function getPlaceOfTransactionAttribute() {
        $site = BookSite::find($this->getAttribute('employee')['site_id']);
        $site_type = BookSiteType::find($site['site_type']);
        $site['site_type_name'] = $site_type['type'];
        return $site;
    }

    public function getIdAttribute($value) {
        return str_pad($value, 8, 0, STR_PAD_LEFT);
    }

    public function getBookIdAttribute($value) {
        return str_pad($value, 10, 0, STR_PAD_LEFT);
    }
}
