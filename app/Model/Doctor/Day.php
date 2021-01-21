<?php

namespace App\Model\Doctor;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function schudules()
    {
        return $this->hasMany(Appdayschedule::class);
    }
}
