@php
$rm = auth()->user()->roleuser->rolemenu;
$menuId = $rm->menu_id;
$menuIdArray = explode(',', $menuId);

$subId = $rm->submenu_id;
$subIdArray = explode(',', $subId);


$ssubId = $rm->ssubmenu_id;
$ssubIdArray = explode(',', $ssubId);



$menus =\App\Model\Security\Menu::with('submenus.ssubmenus')->get();
@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sitebar">
                <li class="menu-title">Main</li>
                @foreach($menus as $m)
                @if(in_array($m->id, $menuIdArray))
                    @if($m->submenus->count())
                    <li class="submenu">
                        <a href="#"><i class="{{$m->icon}}"></i> <span> {{$m->name}} </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @foreach($m->submenus as $sm)
                                @if(in_array($sm->id, $subIdArray))
                                    @if($sm->ssubmenus->count())
                                    <li class="submenu">
                                        <a href="#"><i class="{{$sm->icon}}"></i> <span> {{$sm->name}} </span> <span
                                                class="menu-arrow pt-2"></span></a>
                                        <ul style="display: none;">
                                            @foreach($sm->ssubmenus as $ssm)
                                                @if(in_array($ssm->id, $ssubIdArray))

                                            <li><a href="{{ url('/'.$ssm->action)}}"><i class="{{$ssm->icon}}"></i>
                                                    <span>{{$ssm->name}}</span></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>

                                    @else
                                    <li class="">
                                        <a href="{{url('/'.$sm->action)}}" class="act {{$sm->action? '':'module'}}"><i
                                                class="{{$sm->icon}}"></i> <span>{{$sm->name}}</span></a>
                                    </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </li>

                    @else
                    <li class="">
                        <a href="{{url('/'.$m->action)}}" class="act {{$m->action? '':'module'}}"><i
                                class="{{$m->icon}}"></i> <span>{{$m->name}}</span></a>
                    </li>
                    @endif
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>


<ul class="navbar-nav">
  @foreach($menus as $menu)
    <li class="nav-item dropdown">
      <a class="nav-link {{ count($menu->childs) ? 'dropdown-toggle' :'' }}" 
        href="https://bootstrapthemes.co" id="navbarDropdownMenuLink"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $menu->title }}
      </a>

      <ul class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
        @if(count($menu->childs))
          @include('menu.menusub',['childs' => $menu->childs])
        @endif
      </ul>
    </li>
    @endforeach
</ul>


