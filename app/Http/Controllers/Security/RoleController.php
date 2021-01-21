<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Security\Role;
use App\Model\Security\Roleuser;
use App\Model\Security\Menurole;
use App\Model\Security\Menu;
use App\User;

class RoleController extends Controller
{
    public function roleView()
    {
        $roleUser = Roleuser::with(['user','role'])->get();
        $role = Role::all();
        return view('admin.security.role_view', compact(['role','roleUser']));
    }

    public function rolePage()
    {
        return view('admin.security.add_role');
    }

    public function saveRole(Request $r)    
    {
      $r->request->add(['created_at' => \Carbon\Carbon::now()]);
                  
       $validated = $r->validate([
        'name' => 'required'
    ]);

        Role::insert($r->except('_token'));
        
        return redirect('rolePage');
    }

    public function roleUserPage()
    {
        $roles = Role::all();
        $users = User::all();
        return view('admin.security.add_roleuser', compact(['roles','users']));
    }
    
    public function saveRoleUser(Request $r)    
    {
      $r->request->add(['created_at' => \Carbon\Carbon::now()]);
                  
       $validated = $r->validate([
        'user_id' => 'required',
        'role_id' => 'required'
    ]);

        Roleuser::insert($r->except('_token'));
        
        return redirect('roleUserPage');
    }

    
    function rolemenus()
    {
        $roles = Role::all();
        $menus= \App\Model\Security\Menu::with('childs')->where('parent_id', 0)->get();
        return view('admin.security.role_menu_view', compact(['menus','roles']));
    }


    public function saveRoleMenus(Request $r)    
    {
        //Menu
        //return $r->all();
        
        $menuId = implode(',', $r->menu_id);

        // // Submenu
        // if($r->submenu_id){
        //     $submenu = array();
        //     foreach ($r->submenu_id as $sm) {
        //         $submenu[] = $sm;
        //     }
        //     $submenuId = implode(',', $submenu);
        // }else{
        //     $submenuId = "";
        // }
        

        //  // Ssubmenu
        //  if($r->ssubmenu_id){
        //     $ssubmenu = array();
        //     foreach ($r->ssubmenu_id as $ssm) {
        //         $ssubmenu[] = $ssm;
        //     }
        //      $ssubmenuId = implode(',', $ssubmenu);
        //  }else{
        //     $ssubmenuId = "";
        // }
         
    //   $r->request->add(['created_at' => \Carbon\Carbon::now()]);
    //   $r->request->add(['menu_id' => $menuId]);

                  
       $validated = $r->validate([
        'menu_id' => 'required',
        'role_id' => 'required'
    ]);

    Menurole::updateOrCreate(
        ['role_id' => $r->role_id],
        ['menu_id' => $menuId]
    );
        
        return redirect('rolemenus');
    }

    public function getmenus($id)
    {
       $rm = Menurole::where('role_id',$id)->first();
       return $menuIdArray = explode(',', $rm->menu_id);

    }

}
