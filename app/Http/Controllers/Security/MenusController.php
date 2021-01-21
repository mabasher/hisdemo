<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Security\Menu;


class MenusController extends Controller
{
    public function menusView()
    {
        $icons = DB::table('icons')->get();
        $menus = Menu::all();
        $pm = Menu::where('menu_type','!=','N')->get();
        return view('admin.security.menus_view', compact(['menus','icons','pm']));
    }

    public function saveMenu(Request $r)    
    {
      $r->request->add(['created_at' => \Carbon\Carbon::now()]);
                  
       $validated = $r->validate([
        'name' => 'required'
    ]);

        Menu::insert($r->except('_token'));
        
        return redirect('menusView');
    }
    
}
