<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiviteitConnection extends Model
{
    protected $table = 'activiteit_jongere';

    protected $fillable = [
        'jongere_id',
        'activiteit_id',
        'bedrag',
        'eetmee'
    ];
}
