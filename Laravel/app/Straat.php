<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Straat extends Model
{
    protected $table = 'straten';

    protected $fillable = [
        'straatnaam'
    ];
    public function getAdressen(){
        return $this->hasMany('App/Adres','straat_id');
    }
}
