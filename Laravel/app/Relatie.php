<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relatie extends Model
{
    protected $table = 'relaties';

    protected $fillable = [
        'omschrijving',
    ];
}
