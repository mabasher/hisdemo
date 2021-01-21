<?php

namespace App\Http\Middleware;

use Closure;

class Menupermission
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

        $rm = auth()->user()->roleuser->rolemenu;
        $path = explode('/', $request->path(), 2);


        $menu = \App\Model\Security\Menu::where('action', $path[0])->first();
        if($menu){
            $menuId = $rm->menu_id;
            $menuIdArray = explode(',', $menuId);
            if(in_array($menu->id, $menuIdArray)){
                return $next($request);
    
            }
        }
       

        // $submenu = \App\Model\Security\Submenu::where('action', $path[0])->first();
        // if($submenu){
        //     $subId = $rm->submenu_id;
        //     $subIdArray = explode(',', $subId);
        //     if(in_array($submenu->id, $subIdArray)){
        //         return $next($request);
    
        //     }
        // }
       

        // $ssubmenu = \App\Model\Security\Ssubmenu::where('action', $path[0])->first();
        // if($ssubmenu){
        //     $ssubId = $rm->ssubmenu_id;
        //     $ssubIdArray = explode(',', $ssubId);
        //     if(in_array($ssubmenu->id, $ssubIdArray)){
        //         return $next($request);

        //     }
        // }
        
        return redirect()->back();
        return $next($request);
    }
}