<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    // Mass asignable feilds.
    protected $fillable = ['name', 'domain', 'user_id'];

    // Disables timestamps which is enabled by illuminate by default.
    public $timestamps = false;

    // The table this model is for.
    protected $table = "domains";

    // Gets the associated user
    public function user() {
        return $this->belongsTo('App\User');
    }
}
