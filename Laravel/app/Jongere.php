<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jongere extends Model {
    protected $table = 'jongere';

    protected $fillable = [
        'voornaam',
        'naam',
        'geboortedatum',
        'nationaliteit_id',
        'origine_id',
        'email',
        'facebook'
    ];

    // Converts a timestamp to a Carbon time-format
    protected $dates = ['geboortedatum'];

    public function scopeMeerderjarig($query){

        $query->where('geboortedatum','<',Carbon::now()->subYears(18));

    }

    // this is a Mutator, it converts the format from the
    // form using Carbon to a timestamp format in this case
    // with the time set to 00:00:00
    public function setGeboortedatumAttribute($date){
        //this->attributes['geboortedatum']=Carbon::createFromFormat('Y-m-d',$date);
        $this->attributes['geboortedatum']=Carbon::parse($date);
    }
}