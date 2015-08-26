<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OuderConnection extends Model
{
    protected $table = 'jongere_ouder';

    protected $fillable = [
        'jongere_id',
        'ouder_id',
        'relatie_id'
    ];

    public function relatie(){
        return $this->belongsTo('App\Relatie','relatie_id');
    }


}
