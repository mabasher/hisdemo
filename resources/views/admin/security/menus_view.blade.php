@extends('layouts.app')
@section('css')
<style>
    /* .menuScroll {
    height: 600px;
    overflow-y: auto;
}

.submenuScroll {
    height: 600px;
    overflow-y: auto;
}

.ssubmenuScroll {
    height: 600px;
    overflow-y: auto;
} */

    label {
        display: none !important;
        margin-bottom: .5rem;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-6 m-auto">
            <h4 class="page-title text-center">Menu List</h4>
            <hr>

            <div class="col-md-8 m-auto">
                <div class="form-row">
                    <!-- <legend for="">Module Wise Menus</legend> -->
                    <div class="col-md-9 mb-3">
                        <h4>
                            <select class="custom-select text-center text-success" id="modMenu">
                                <option value="null">Module Wise Menus</option>
                                @foreach($modWiseMenu as $mwm)
                                <option value="{{$mwm->id}}">
                                    {{$mwm->name}}</option>
                                @endforeach
                            </select>
                        </h4>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="" type="button" id="menuMAdd" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary filterable">
                <table class="table table-striped custom-table datatable" id="modWiseMenu">
                    <thead>
                        <tr class="filters">
                            <th>#</th>
                            <th><input type="text" class="form-control" placeholder="Main Menu"></th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $m)
                        <tr>
                            <td class="text-center">{{$loop->iteration }}</td>
                            <td>{{$m->name }}</td>
                            <td class="text-center">
                                <a class="editmenu" data-toggle="modal" data-target="#editMenu" href=""
                                     data-id="{{ $m->id }}" data-menuname="{{ $m->name }}" data-action="{{ $m->action }}" 
                                     data-parentId="{{ $m->parent_id }}" data-icon="{{ $m->icon }}" data-menuType="{{ $m->menu_type }}" 
                                     data-remark="{{ $m->remark }}">
                                     <i class="fa fa-pencil m-r-5"> </i>
                                </a>
                                <a class="dlt" data-id="{{$m->id}}" href="#"><i class="fa fa-trash-o m-r-5 text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Menu Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" method="POST" action="{{url('saveMenu')}}">
                            @csrf
                            <div class="form-group">
                                <label>Menu Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Menu Name">
                            </div>
                            <div class="form-group">
                                <label>Parent Menu</label>
                                <select class="custom-select" id="parentId" name="parent_id">
                                    <option value="">Select Parent Menu</option>
                                    @foreach($pm as $pm)
                                    <option value="{{$pm->id}}">{{$pm->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Menu Type</label>
                                <select class="custom-select" id="menuType" name="menu_type" required>
                                    <option value="">Select Menu Type</option>
                                    <option value="M">Module</option>
                                    <option value="S">Sub Module</option>
                                    <option value="F">Form</option>
                                    <option value="R">Report</option>
                                    <option value="N">None</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Menu Action</label>
                                <input class="form-control" type="text" name="action" placeholder="Menu Action">
                            </div>
                            <div class="form-group">
                                <label for="">Menu Icon</label>
                                <select class="custom-select" id="icon" name="icon">
                                    <option value="">Select Icon</option>
                                    @foreach($icons as $icon)
                                    <option value="{{$icon->icon_name}}">{{$icon->icon_name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea cols="30" rows="2" name="remark" class="form-control" placeholder="Remarks"></textarea>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Menu Update Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" method="POST" action="{{url('updateMenu')}}">
                            @csrf
                            <div class="form-group">
                                <label>Menu Name</label>
                                <input class="form-control" type="text" id="menuName" name="name" placeholder="Menu Name">
                                <input class="form-control" type="hidden" id="menuId" name="id">
                            </div>
                            <div class="form-group">
                                <label>Parent Menu</label>
                                <select class="custom-select" id="parentId" name="parent_id">
                                    <option value="">Select Parent Menu</option>
                                   
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Menu Type</label>
                                <select class="custom-select" id="menuType" name="menu_type" required>
                                    <option value="">Select Menu Type</option>
                                    <option value="M">Module</option>
                                    <option value="S">Sub Module</option>
                                    <option value="F">Form</option>
                                    <option value="R">Report</option>
                                    <option value="N">None</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Menu Action</label>
                                <input class="form-control" type="text" id="action" name="action" placeholder="Menu Action">
                            </div>
                            <div class="form-group">
                                <label for="">Menu Icon</label>
                                <select class="custom-select" id="icon" name="icon">
                                    <option value="">Select Icon</option>
                                    @foreach($icons as $icon)
                                    <option value="{{$icon->icon_name}}">{{$icon->icon_name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea cols="30" rows="2" id="remark" name="remark" class="form-control" placeholder="Remarks"></textarea>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="delete_Menu" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{asset('admin/img/sent.png')}}" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this Menu Item?</h3>
                    <input id="deleteId" type="hidden">
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <a class="btn btn-danger deleteConfirm">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript">
    $('#menuMAdd').on('click', function(e) {
        e.preventDefault();
        $('#addMenu').modal('show');
    });

    $('.dataTable').DataTable();

    $('.filterable .btn-filter').click(function() {
        var $panel = $(this).parents('.filterable'),
            $filters = $panel.find('.filters input'),
            $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e) {
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
            inputContent = $input.val().toLowerCase(),
            $panel = $input.parents('.filterable'),
            column = $panel.find('.filters th').index($input.parents('th')),
            $table = $panel.find('.table'),
            $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function() {
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table
                .find('.filters th').length + '">No result found</td></tr>'));
        }
    });


    $('#modMenu').on('change', function() {
        var modparentId = $(this).val();
        getModuleWiseMenus(modparentId);

    })

    function getModuleWiseMenus(id) {
        $.ajax({
            url: "{{url('menusModWise')}}/" + id,
            type: 'get',
            success: function(data) {
                $('#modWiseMenu').html(data);
            }
        })
    }

    $('.editmenu').on('click', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $('#menuId').val(id);
            var parentId = $(this).attr('data-parentId');
            $('#parentId').val(parentId);
            var name = $(this).attr('data-menuname');
            $('#menuName').val(name);
            var menuType = $(this).attr('data-menutype');
            $('#menuType').val(menuType);
            var action = $(this).attr('data-action');
            $('#action').val(action);
            var icon = $(this).attr('data-icon');
            $('#icon').val(icon);
            var remark = $(this).attr('data-remark');
            $('#remark').val(remark);
        })

    $(function() {
        $(document).on('click', '.dlt', function(e) {
            e.preventDefault();
            $('#deleteId').val($(this).attr('data-id'));
            $('#delete_Menu').modal('show');
        });

        $(document).on('click', '.deleteConfirm', function() {
            var id = $('#deleteId').val();
            var url = "{{url('menusDelete')}}/" + id;
            $(this).prop("href", url);
            $('#delete_Menu').modal('hide');
        })
    })


</script>
@endsection