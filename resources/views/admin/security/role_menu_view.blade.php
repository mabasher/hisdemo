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
            <div class="tree ">
                <ul>
                    <li>
                        <span>
                            <a href="#" aria-expanded="true" aria-controls="Web">
                                <input type="checkbox" id="parentId" value="" />
                                <label class="checkbox-inline">HIS</label>
                            </a>
                        </span>
                        <ul>
                            @foreach($menus as $menu)
                            <li>
                                <span>
                                    <input type="checkbox" id="cb{{$menu->id}}" data-id="{{$menu->id}}" class="menus"
                                        name="menu_id[]" value="{{$menu->id}}" />
                                    <a style="color:#000; text-decoration:none;" data-toggle="collapse"
                                        href="#m{{$menu->id}}" aria-expanded="true" aria-controls="m{{$menu->id}}">
                                        <!-- <i class="collapsed"><i class="fa fa-folder"></i></i>
                                        <i class="expanded"><i class="fa fa-folder-open"></i></i> -->
                                        <label class="checkbox-inline">{{$menu->name}}

                                            <!-- <i class="{{count($menu->childs)?'fa fa-arrow-down':''}}" ></i> -->
                                        </label>
                                    </a>
                                </span>
                                @if(count($menu->childs))
                                <div id="m{{$menu->id}}" class="collapse {{count($menu->childs) ? 'show':''}}">
                                    <ul>
                                        @if(count($menu->childs))
                                        @include('admin.security.role_menu_sub',['childs' => $menu->childs])
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </form>
    <!-- end -->

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


$('#role').on('change', function() {
    var roleid = $(this).val();
    getMenus(roleid);
})

function getMenus(id) {
    $.ajax({
        url: "{{url('getmenus')}}/" + id,
        type: "Get",
        success: function(data) {

            $('.menus').each(function(i, obj) {

                if (data.includes($(this).attr('data-id'))) {
                    $(this).prop('checked', true);
                }
                else{
                    $(this).prop('checked', false);
                }

            });

        }
    })
}
</script>
@endsection