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
        $modWiseMenu = Menu::where('menu_type','M')->get();
        return view('admin.security.menus_view', compact(['menus','icons','pm','modWiseMenu']));
    }

    public function menusModWise($parentId)
    {
        $modWise = Menu::where('parent_id',$parentId)->get();
        return view('admin.security.modwise_menus_view', compact(['modWise']));
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

    public function updateMenu(Request $r)    
    {
      $r->request->add(['updated_at' => \Carbon\Carbon::now()]);
      $r->request->add(['updated_by' => auth()->user()->id]);
                  
       $validated = $r->validate([
        'name' => 'required'
    ]);

      Menu::where('id',$r->id)->update($r->except('_token'));        
      return redirect('menusView');
    }

    
    public function menusDelete($id)
      {
        Menu::where('id',$id)->delete();
        return redirect('menusView');
      }
    
}
