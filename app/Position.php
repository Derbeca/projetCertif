<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [ 'lat', 'long', "annonce_id" ];

    public function annonce()
    {
        return $this->belongsTo('App\Annonce');
    }
    
    
}

