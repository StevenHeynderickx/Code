<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activiteit extends Model
{
    protected $table = 'activiteiten';

    protected $fillable = [
            'id',
            'omschrijving',
            'prijs',
            'maaltijd',
            'datum',
    ];
    public function getPositivePrijs(){
        return abs($this->prijs);
    }

    public function getJongeren(){
        return $this->belongsToMany('App\Jongere',"activiteit_jongere")->withTimestamps()->withPivot('bedrag','eetmee','id');
    }

    public function inschrijvingen(){
        return $this->hasMany('App\ActiviteitConnection','activiteit_id');
    }
    public function stortingen(){
        return $this->hasMany('App\ActiviteitConnection','activiteit_id');
    }
    public function countInschrijvingen(){
        return $this->inschrijvingen()
            ->selectRaw('activiteit_id, count(*) as inschrijvingen')
            ->groupBy('activiteit_id');
    }
    public function countMaaltijden(){
        return $this->inschrijvingen()
            ->selectRaw('activiteit_id, count(*) as maaltijden')
            ->where('eetmee',1)
            ->groupBy('activiteit_id');
    }
    public function countStortingen(){
        return $this->stortingen()
            ->selectRaw('activiteit_id, count(*) as stortingen, sum(bedrag) as totaal')
            ->where('bedrag','>',0)
            ->groupBy('activiteit_id');
    }


}

