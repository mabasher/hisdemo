<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appdayschedule extends Model
{
    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
