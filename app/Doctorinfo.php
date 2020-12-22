<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctorinfo extends Model
{
    public function schedules()
    {
        return $this->hasMany(Appdayschedule::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'dept_no','dept_no');
    }
}
