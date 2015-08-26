<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Relatie;

class Ouder extends Model
{
    protected $table = 'ouders';

    protected $fillable = [
        'naam',
        'voornaam',
        'origine_id'
    ];

    public function getJongeren()
    {
        return $this->belongsToMany('App\Jongere', 'jongere_ouder')->withTimestamps()->withPivot('relatie_id');
    }

    public function getRelatie($relatieId){
        return Relatie::first($relatieId);
    }

    public function origine(){
        return $this->belongsTo('App\Nationaliteit','origine_id');
    }

    public function getOrigine()
    {
        $origine = Nationaliteit::findOrFail($this->origine_id);
        //dd($origine->omschrijving);
        return $origine->omschrijving;


    }

    public function getOrigineId($id)
    {
        $origine = Nationaliteit::findOrFail($id);
        //dd($origine->omschrijving);
        return $origine->omschrijving;


    }

}
