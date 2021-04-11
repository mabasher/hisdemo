<?php

namespace App\Policies;

use App\Model\Doctor\Doctorinfo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PolicyCrud
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    // public function update(User $user,Doctorinfo $doctorinfo)
    // {
    //     dd($user->id === $doctorinfo->user_id);
        
    // }
}
