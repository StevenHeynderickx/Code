<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gemeente extends Model
{
    protected $table = 'gemeenten';

    protected $fillable = [
        'gemeente',
        'postcode'
    ];
    public function getAdressen(){
        return $this->hasMany('App/Adres','gemeente_id');
    }
}
