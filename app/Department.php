<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $gurded = [];
    
    public function doctors()
    {
        return $this->hasMany(Doctorinfo::class,'dept_no','dept_no');
    }
}
