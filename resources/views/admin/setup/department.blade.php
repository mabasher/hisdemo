@extends('layouts.app')
    @section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">

    @endsection
    @section('content')    
        
            <div class="content">
                <div class="row">
                    <div class="col-sm-5 col-5">
                        <h4 class="page-title">Departments</h4>
                    </div>
                    <div class="col-sm-7 col-7 text-right m-b-30">
                        <a href="{{url('departmentAdd')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Department</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Dept No</th>
                                        <th>Departments t</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $dept)
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>{{$dept->dept_no }}</td>
                                        <td>{{$dept->dept_name }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="edit-department.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item dlt" data-id="{{$dept->id}}" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
            $(function(){
                $('.dlt').on('click',function(e){
                e.preventDefault();
                $('#deleteId').val($(this).attr('data-id'));
                $('#delete_department').modal('show');
                });

                $('.deleteConfirm').on('click',function(e){
                e.preventDefault();
                var id = $('#deleteId').val();
                var url = "{{url('deptDelete')}}/" + id;
                $(this).prop("href", url);
                $('#delete_department').modal('hide');
                })
            })
            
        </script>
    @endsection
    