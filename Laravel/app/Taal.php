<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Taal extends Model
{
    protected $table = 'talen';

    protected $fillable = [
        'omschrijving'
    ];

    public function getJongere(){
        return $this->belongsToMany('App\Jongere',"jongere_taal")->withTimestamps();
    }

}
