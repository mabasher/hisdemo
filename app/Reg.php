<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
    public function name()
    {
        return $this->belongsTo(Name::class);
    }

    public function salutation()
    {
        return $this->belongsTo(Salutation::class, 's_id', 'id');
    }


}

