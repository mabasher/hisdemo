<?php

namespace App\Model\Security;

use Illuminate\Database\Eloquent\Model;

class Roleuser extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    // Basher Create
    public function rolemenu()
    {
        return $this->hasOne(Menurole::class, 'role_id', 'role_id');
    }

}
