<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Huisarts extends Model
{
    protected $table = 'huisartsen';

    protected $fillable = [
        'naam',
        'voornaam',
        'contactnummer',
        'url',
        'straat_id',
        'nummer',
        'bus',
        'gemeente_id',
    ];

    public function getJongeren(){
        return $this->belongsToMany('App\Jongere',"huisarts_jongere")->withTimestamps();
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
