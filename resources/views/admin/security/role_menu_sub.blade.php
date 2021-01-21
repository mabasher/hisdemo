@foreach($childs as $menu)
<li>
    <span>
        <input type="checkbox" id="menuId" name="menu_id[]" value="{{$menu->id}}" data-id="{{$menu->id}}" class="menus"/>
        <a style="color:#000; text-decoration:none;" data-toggle="collapse" class="submenus" href="#m{{$menu->id}}" aria-expanded="true"
            aria-controls="m{{$menu->id}}">
            <!-- <i class="collapsed"><i class="fa fa-folder"></i></i>
            <i class="expanded"><i class="fa fa-folder-open"></i></i> -->
            {{$menu->name}}
        </a>
    </span>
    @if(count($menu->childs))
    <div id="m{{$menu->id}}" class="collapse {{count($menu->childs)?'show':''}}">
        <ul>

            @if(count($menu->childs))
            @include('admin.security.role_menu_sub',['childs' => $menu->childs])
            @endif

        </ul>
    </div>
    @endif
</li>
@endforeach