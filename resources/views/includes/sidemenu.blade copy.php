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

                <!-- <li class="submenu">
                    <a href="javascript:void(0);">
                        <i class="fa fa-share-alt"></i>
                        <span>Multi Level</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li class="submenu">
                            <a href="javascript:void(0);"><span>Level 1</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"> <span> Level 2</span> <span
                                            class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                            </ul>
                        </li>
                       
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>
