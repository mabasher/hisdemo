<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salutation extends Model
{
    public function reg()
    {
        return $this->hasOne(Reg::class);
    }
}
