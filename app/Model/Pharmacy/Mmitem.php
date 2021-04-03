<?php

namespace App\Model\Pharmacy;

use App\Model\Doctor\Dctestmst;
use Illuminate\Database\Eloquent\Model;

class Mmitem extends Model
{
    public function producttype()
    {
        return $this->hasOne(Pmproducttype::class, 'product_type_no','product_type_no');
    }

    public function stockqty()
    {
       return $this->hasMany(Mmitemstock::class,'item_no','item_no');
    }

    public function mmuom()
    {
       return $this->hasOne(Mmuom::class,'uom_no','strength_unit_no');
    }

}
