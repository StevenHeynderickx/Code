<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Straat;
use App\Gemeente;

class Adres extends Model
{
    protected $table = 'adressen';

    protected $fillable = [
        'omschrijving',
        'officieel',
        'straat_id',
        'nummer',
        'bus',
        'gemeente_id',
    ];

    public function getJongeren(){
        return $this->belongsToMany('App\Jongere',"adres_jongere")->withTimestamps();
    }
    public function getStraat(){
        $straat=Straat::findOrFail($this->straat_id);
        //dd($straat->straatnaam);
        return $straat->straatnaam;
    }
    public function getGemeente(){
        $gemeente=Gemeente::findOrFail($this->gemeente_id);
        return $gemeente;
    }

}
