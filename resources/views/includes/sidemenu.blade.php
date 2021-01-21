@php
$rm = auth()->user()->roleuser->rolemenu;
$menuIdArray = explode(',', $rm->menu_id);
$menus= \App\Model\Security\Menu::with('childs')->where('parent_id', 0)->get();

@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul class="sitebar">
                <li class="menu-title">Main</li>
                @foreach($menus as $menu)
                 @if(in_array($menu->id, $menuIdArray))
                <li class="{{ count($menu->childs) ? 'submenu' :'' }}">
                    <a href="{{ $menu->action ? url($menu->action) :'javascript:void(0);'}}">
                        <i class="{{$menu->icon}}"></i>
                        <span>{{ $menu->name }}</span>
                        <span class="{{ count($menu->childs) ? 'menu-arrow' :'' }}"></span>
                    </a>

                    <ul style="display: none;">
                        @if(count($menu->childs))
                            @include('includes.menusub',['childs' => $menu->childs, 'menuIdArray'=>$menuIdArray])
                        @endif
                    </ul>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>