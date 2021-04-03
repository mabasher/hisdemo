<?php

namespace App\Http\Middleware;

use App\Model\Security\Menu;
use App\Model\Security\Menurole;
use Closure;

class HasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $menu = Menu::where('action', $request->path())->first()->id;
        $roleMenu = Menurole::where('role_id', auth()->user()->roleuser->role_id)->first()->menu_id;
        if(in_array($menu, explode(',',$roleMenu))){

            return $next($request);
        }
        return redirect('home');
    }
}
