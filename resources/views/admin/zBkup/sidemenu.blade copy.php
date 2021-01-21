@php
    $user = auth()->user();
    $menus =\App\User::find($user->id)->roleuser->role->menus->load('submenus.ssubmenus');
@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul  class="sitebar">
                <li class="menu-title">Main</li>
                @foreach($menus as $m)
                    @if($m->submenus->count())
                        <li class="submenu">
                            <a href="#"><i class="{{$m->icon}}"></i> <span> {{$m->name}} </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                @foreach($m->submenus as $sm)

                                
                                <li><a href="{{ url('/'.$sm->action)}}"><i class="{{$sm->icon}}"></i> <span>{{$sm->name}}</span></a></li>
                                @endforeach
                            </ul>
                        </li>

                    @else
                        <li class="">
                            <a href="{{url('/'.$m->action)}}" class="act {{$m->action? '':'module'}}"><i class="{{$m->icon}}"></i> <span>{{$m->name}}</span></a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>



