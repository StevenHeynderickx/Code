<?php
/**
 * Created by PhpStorm.
 * User: Steven
 * Date: 14/07/15
 * Time: 15:27
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Nationaliteit extends Model{
    protected $table = 'nationaliteiten';

    protected $fillable = [
        'omschrijving',
        'afkorting'
    ];

    public function getJongeren(){
        return $this->belongsToMany('App\Jongere','jongere_nationaliteit')->withTimestamps();
        // tweede argument is de naam van de pivot-tabel
    }

    public function asOrigineForJongere()
    {
        return $this->hasMany('App/Jongere');
    }

}