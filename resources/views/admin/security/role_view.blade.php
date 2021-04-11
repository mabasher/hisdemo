@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
<style>
.menuScroll {
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
}
</style>
@endsection
@section('content')

<div class="content">
    <div class="row">
        <!-- <div class="col-sm-5 col-5">
            <h4 class="page-title">Role Information</h4>
        </div> -->
    </div>
    <div class="row">

        <div class="col-md-6 submenuScroll">
            <h4 class="page-title">Role Information</h4>
            <div class="table-responsive">
                <div class="panel panel-primary filterable">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr class="filters">
                                <th>#</th>
                                <th><input type="text" class="form-control" placeholder="Role Name"></th>
                                <th class="text-right"><a href="{{url('rolePage')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($role as $r)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{$r->name }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="edit-department.html"><i
                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item dlt" data-id="{{$r->id}}" href="#"><i
                                                    class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 menuScroll">
            <h4 class="page-title">Role Assign Information</h4>
            <div class="table-responsive">
                <div class="panel panel-primary filterable">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr class="filters">
                                <th>#</th>
                                <th><input type="text" class="form-control" placeholder="User Name"></th>
                                <th><input type="text" class="form-control" placeholder="Role Name"></th>
                                <th class="text-right"><a href="{{url('roleUserPage')}}" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roleUser as $ru)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{$ru->user->name }}</td>
                                <td>{{$ru->role->name }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="edit-department.html"><i
                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item dlt" data-id="{{$r->id}}" href="#"><i
                                                    class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>


<div id="delete_department" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('admin/img/sent.png')}}" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Department?</h3>
                <input id="deleteId" type="hidden">
                <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <a class="btn btn-danger deleteConfirm">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
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
</script>
@endsection