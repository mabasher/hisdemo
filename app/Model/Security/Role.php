<?php

namespace App\Model\Security;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $gurded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
