@extends('layouts.app')
    @section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">

    @endsection
    @section('content')    
        
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Role</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form autocomplete="off" method="POST" action="{{url('saveRoleUser')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">User Name</label>
                                <select class="custom-select" id="user" name="user_id">
                                    <option value="">Select User Name</option>
                                    @foreach($users as $u)
                                        <option value="{{$u->id}}">{{$u->name}}
                                        </option>
                                    @endforeach
                                    
                                </select>
							</div>
                            <div class="form-group">
                                <label for="">Role Name</label>
                                <select class="custom-select" id="role" name="role_id">
                                    <option value="">Select Role Name</option>
                                    @foreach($roles as $r)
                                        <option value="{{$r->id}}">{{$r->name}}
                                        </option>
                                    @endforeach
                                    
                                </select>
							</div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea cols="30" rows="2" name="remark" class="form-control"></textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button  type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('roleView')}}" class="btn btn-success">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        
		<div id="delete_department" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Department?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    @endsection
    @section('js')
        <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="">
        
        </script>
    @endsection
    <!-- <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/js/app.js')}}"></script> -->



<!-- departments23:21-->