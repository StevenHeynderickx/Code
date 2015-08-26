<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groep extends Model
{
    protected $table = 'groepen';

    protected $fillable = [
        'omschrijving'
    ];
    public function getJongeren(){
        return $this->belongsToMany('App\Jongere','groep_jongere')->withTimestamps();
    }

}
