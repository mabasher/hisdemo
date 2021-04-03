@extends('layouts.app')
@section('css')
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
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content')

<div class="content">
    <div class="row">
        <div class="col-md-1 ">
        </div>
        <div class="col-md-5 menuScroll">
            <h4 class="page-title">Menu Information</h4>
            <div class="table-responsive">
                <div class="panel panel-primary filterable">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr class="filters">
                                <th>#</th>
                                <th><input type="text" class="form-control" placeholder="Main Menu"></th>
                                <th></th>
                                <!-- <th class="text-right">
                                    <a href="{{url('menusPage')}}" class="btn btn-primary btn-rounded"><i
                                            class="fa fa-plus"></i> Add </a>
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $m)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{$m->name }}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="edit-department.html"><i
                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item dlt" data-id="{{$m->id}}" href="#"><i
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
        
        <div class="col-md-6">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form autocomplete="off" method="POST" action="{{url('saveMenu')}}">
                        <h4 class="page-title">Menu Information</h4>
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
                                <option value="{{$pm->id}}">{{$pm->name}}
                                </option>
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
                            <textarea cols="30" rows="2" name="remark" class="form-control"></textarea>
                        </div>

                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <!-- <a href="{{url('menusView')}}" class="btn btn-success">Back</a> -->
                        </div>
                    </form>
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