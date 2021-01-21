@foreach($childs as $menu)
    @if(in_array($menu->id, $menuIdArray))
  <li class="{{ count($menu->childs) ? 'submenu' :'' }}">
      <a href="{{ $menu->action ? url($menu->action) :'javascript:void(0);'}}">
          <i class="{{$menu->icon}}"></i>
          <span>{{ $menu->name }}</span>
          <span class="{{ count($menu->childs) ? 'menu-arrow mt-2' :'' }}"></span>
      </a>

      <ul style="display: none;">
          @if(count($menu->childs))
          @include('includes.menusub',['childs' => $menu->childs])
          @endif
      </ul>
  </li>
    @endif
  @endforeach
