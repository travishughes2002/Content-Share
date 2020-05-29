<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    // Mass asignable feilds.
    protected $fillable = ['pathname', 'slug', 'user_id'];

    // Disables timestamps which is enabled by illuminate by default.
    public $timestamps = false;

    // The table this model is for.
    protected $table = "images";

    // Gets the associated user
    public function user() {
        return $this->belongsTo('App\User');
    }
}
