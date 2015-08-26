<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Relatie;


class Jongere extends Model {
    protected $table = 'jongeren';

    protected $fillable = [
        'voornaam',
        'naam',
        'geboortedatum',
        'email',
        'facebook',
        'origine_id'
    ];

    public function origine(){
        return $this->belongsTo('App\Nationaliteit','origine_id');
    }

    public function nationaliteit(){
        return $this->belongsToMany('App\Nationaliteit','jongere_nationaliteit')->withTimestamps();
    }
    public function taal(){
        return $this->belongsToMany('App\Taal','jongere_taal')->withTimestamps();
    }
    public function extrainfo(){
        return $this->belongsToMany('App\Extrainfo','extrainfo_jongere')->withTimestamps();
    }
    public function adres(){
        return $this->belongsToMany('App\Adres','adres_jongere')->withTimestamps();
    }
    public function huisarts(){
        return $this->belongsToMany('App\Huisarts','huisarts_jongere')->withTimestamps();
    }
    public function groep(){
        return $this->belongsToMany('App\Groep','groep_jongere')->withTimestamps();
    }
    public function ouder(){
        return $this->belongsToMany('App\Ouder','jongere_ouder')->withTimestamps()->withPivot('relatie_id');
    }
    public function getOuderRelatie($ouderId){

        $relatie_id = DB::table('jongere_ouder')->where('jongere_id',$this->id)->where('ouder_id',$ouderId)->get()[0]->relatie_id;
$ouderRelatie = Relatie::find($relatie_id)->omschrijving;
        return $ouderRelatie;
    }


    public function getAllActiviteiten(){
        return $this->belongsToMany('App\Activiteit','activiteit_jongere')
            ->withTimestamps()
            ->withPivot('bedrag','eetmee');
    }

    public function getActiviteit(){
        return $this->belongsToMany('App\Activiteit','activiteit_jongere')
            ->withTimestamps()
            ->withPivot('bedrag','eetmee')
            ->where('bedrag','<=',0);
    }
    public function getStorting(){
        return $this->belongsToMany('App\Activiteit','activiteit_jongere')
            ->withTimestamps()
            ->withPivot('bedrag','eetmee')
            ->where('bedrag','>',0);
    }
    public function getActiviteiten(){
        return $this->getActiviteit()
            ->selectRaw('jongere_id, sum(bedrag) as totaalBetaald, sum(prijs) as totaalPrijs')
            ->groupBy('jongere_id');
    }
    public function getStortingenSaldo(){
        return $this->getStorting()
            ->selectRaw('jongere_id, sum(bedrag) as totaalStortingen')
            ->groupBy('jongere_id');
    }
    public function getSaldo(){
        $totaalStortingen = $this->getStortingenSaldo()->first()['totaalStortingen'];
        $totaalStortingen = $totaalStortingen == null ? 0 : $totaalStortingen;
        $totaalPrijs = $this->getActiviteiten()->first()['totaalPrijs'];
        $totaalPrijs = $totaalPrijs == null ? 0 : $totaalPrijs;
        $totaalBetaald = $this->getActiviteiten()->first()['totaalBetaald'];
        $totaalBetaald = $totaalBetaald == null ? 0 : $totaalBetaald;
        return $totaalStortingen-$totaalBetaald+$totaalPrijs;
    }


    // Converts a timestamp to a Carbon time-format
    // protected $dates = ['geboortedatum'];

    public function scopeMeerderjarig($query){

        $query->where('geboortedatum','<',Carbon::now()->subYears(18));

    }


}