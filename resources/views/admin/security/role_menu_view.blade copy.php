@extends('layouts.app')
@section('css')
<style>
.slotScroll {
    height: 510px;
    overflow-y: auto;
}

.tree li {
    list-style-type: none;
    margin: 0;
    padding: 10px 5px 0 5px;
    position: relative
}

.tree li::before,
.tree li::after {
    content: '';
    left: -20px;
    position: absolute;
    right: auto
}

.tree li::before {
    border-left: 2px solid #000;
    bottom: 50px;
    height: 100%;
    top: 0;
    width: 1px
}

.tree li::after {
    border-top: 2px solid #000;
    height: 20px;
    top: 25px;
    width: 25px
}

.tree li span {
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border: 2px solid #000;
    border-radius: 3px;
    display: inline-block;
    padding: 3px 8px;
    text-decoration: none;
    cursor: pointer;
}

.tree>ul>li::before,
.tree>ul>li::after {
    border: 0
}

.tree li:last-child::before {
    height: 27px
}

/* 
.tree li span:hover {
    background: hotpink;
    border: 2px solid #94a0b4;
} */

[aria-expanded="false"]>.expanded,
[aria-expanded="true"]>.collapsed {
    display: none;
}
</style>
@endsection
@section('content')

<div class="content ">
    
    <!-- start -->
    <!-- https://bootsnipp.com/snippets/orp8g -->
    <form method="POST" action="{{url('saveRoleMenus')}}">
        @csrf
        <div class="col-sm-6 col-6 m-auto border border-success">
            <h4 class="page-title text-success">Role Wise Menu Information</h4>
            <div class="form-row">
                <div class="col-md-10 mb-3">
                    <select class="custom-select" id="role" name="role_id" required>
                        <option value="">Select Role Name</option>
                        @foreach($roles as $r)
                            <option value="{{$r->id}}">{{$r->name}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="tree slotScroll">
                <ul>
                    <li>
                        <span >
                            <a href="#" aria-expanded="true" aria-controls="Web">
                                <input type="checkbox" id="parentId" value="" />
                                <label class="checkbox-inline">HIS</label>
                            </a>
                        </span>
                        <ul>
                            @foreach($menus as $m)
                            <li>
                                <span class="hm">
                                    <a href="#" aria-expanded="true" data-toggle="collapse" href="#Web" aria-controls="Web">
                                        <input type="checkbox" class="menu" id="menuId" name="menu_id[]" value="{{$m->id}}" />
                                        <label class="checkbox-inline">{{$m->name}}</label>
                                    </a>
                                </span>
                                <ul>
                                    @foreach($m->submenus as $sm)
                                    <li>
                                        <span>
                                            <a style="color:#000; text-decoration:none;" href="#" aria-expanded="false">
                                                <input type="checkbox" class="submenu" id="submenuId"  name="submenu_id[]" value="{{$sm->id}}" />
                                                <label class="checkbox-inline">{{$sm->name}}</label>
                                            </a>
                                        </span>
                                        <ul>
                                            @foreach($sm->ssubmenus as $ssm)
                                            <li>
                                                <span>
                                                    <a style="color:#000; text-decoration:none;" href="#" aria-expanded="false">
                                                        <input type="checkbox" class="ssubmenu" id="ssubmenuId" name="ssubmenu_id[]" value="{{$ssm->id}}" />
                                                        <label class="checkbox-inline">{{$ssm->name}}</label>
                                                    </a>
                                                </span>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </form>
    <!-- end -->
    <li>
                    
                        <span>
                            <a style="color:#000; text-decoration:none;" data-toggle="collapse" href="#{{$menu->name}}"
                                aria-expanded="true" aria-controls="Web"><i class="collapsed"><i
                                        class="fa fa-folder"></i></i>
                                <i class="expanded"><i class="fa fa-folder-open"></i></i>
                                {{$menu->name}}
                            </a>
                        </span>
                        @if(count($menu->childs))
                        <div id="{{$menu->name}}" class="collapse {{$loop->first ? 'show':''}}">
                            <ul>
                                <li><span><a style="color:#000; text-decoration:none;" data-toggle="collapse"
                                            href="#Page2" aria-expanded="false" aria-controls="Page2"><i
                                                class="collapsed"><i class="fas fa-folder"></i></i>
                                            <i class="expanded"><i class="far fa-folder-open"></i></i> Page 2</a></span>
                                    <ul>
                                        <div id="Page2" class="collapse">
                                            <li><span><i class="far fa-file"></i><a href="#!"> Link
                                                2</a></span></li>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </li>
                    

    <!-- https://stackoverflow.com/questions/31499516/how-to-retrive-data-from-database-to-a-treeview-using-laravel -->
</div>
@endsection
@section('js')
<script>
    //http://jsfiddle.net/7uR2B/
    $('li :checkbox').on('click', function() {
        var $chk = $(this),
            $li = $chk.closest('li'),
            $ul, $parent;
        if ($li.has('ul')) {
            $li.find(':checkbox').not(this).prop('checked', this.checked)
        }
        do {
            $ul = $li.parent();
            $parent = $ul.siblings(':checkbox');
            if ($chk.is(':checked')) {
                $parent.prop('checked', $ul.has(':checkbox:not(:checked)').length == 0)
            } else {
                $parent.prop('checked', false)
            }
            $chk = $parent;
            $li = $chk.closest('li');
        } while ($ul.is(':not(.someclass)'));
    });
 
    $('.submenu').on('change',function(){
        console.dir($(this).closest('.menu'));
        var $chk = $(this);
        var $li = $chk.closest('.menu').find('.menu').attr('checked');
    })

</script>
@endsection


@foreach($menus as $menu)
                            <li class="{{ count($menu->childs) ? 'submenu' :'' }}">
                                <a href="{{ $menu->action ? url($menu->action) :'javascript:void(0);'}}">
                                    <i class="{{$menu->icon}}"></i>
                                    <span>{{ $menu->name }}</span>
                                    <span class="{{ count($menu->childs) ? 'menu-arrow' :'' }}"></span>
                                </a>

                                <ul style="display: none;">
                                    @if(count($menu->childs))
                                        @include('admin.security.role_menu_sub',['childs' => $menu->childs])
                                    @endif
                                </ul>
                            </li>
                            @endforeach