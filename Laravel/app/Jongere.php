<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}