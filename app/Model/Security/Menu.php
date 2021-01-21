<?php

namespace App\Model\Security;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $gurded = [];

    public function childs()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
