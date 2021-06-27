<?php

namespace App\Model\Doctor;

use App\Model\Pharmacy\Mmitem;
use App\Model\Setup\Department;
use Illuminate\Database\Eloquent\Model;

class Dctestmst extends Model
{

    public function mmitems()
    {
        return $this->hasOne(Mmitem::class, 'item_no','test_no');
    }

    public function departments()
    {
        return $this->hasOne(Department::class, 'dept_no','dept_no');
    }

    // public function investigations()
    // {
    //     return $this->hasMany(Fninvoicechd::class, 'item_no','test_no');
    // }

}
