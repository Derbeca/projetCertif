<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Annonce extends Model
{
    protected $fillable = [
        "titre", "auteur", "description", "photo", "user_id",
    ];
    // ON DECLARE LA RELATION ONE-TO-MANY
    // https://laravel.com/docs/4.2/eloquent#eager-loading
    // CETTE METHODE PERMETTRA DE FAIRE UN READ 
    // AVEC with \App\Annonce::with('user')
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
