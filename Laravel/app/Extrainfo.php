<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extrainfo extends Model
{
    protected $table = 'extrainfos';

    protected $fillable = [
        'omschrijving',
        'priority'
    ];
}
