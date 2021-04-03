@extends('layouts.app')
    @section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/dataTables.bootstrap4.min.css')}}">

    @endsection
    @section('content')    
        
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Department</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form autocomplete="off" method="POST" action="{{url('saveDepartment')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">Level</label>
                                <select class="custom-select" id="orgId" name="organogramsetup_id">
                                    <option value="">Select Level</option>
                                    @foreach($organogram as $org)
                                        <option value="{{$org->hr_organid}}">{{$org->hr_organname}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Department</label>
                                <select class="custom-select" id="parentDept" name="parent_dept">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $d)
                                        <option value="{{$d->dept_no}}">{{$d->dept_name}}
                                        </option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="form-group">
								<label>Sub Department</label>
								<input class="form-control" type="text" name="dept_name">
                            </div>
                            <div class="form-group">
                                <label for="">Area Type</label>
                                <select class="custom-select" id="areaType" name="area_type_no">
                                    <option value="">Select Department</option>
                                    @foreach($areatype as $area)
                                        <option value="{{$area->area_type_no}}">{{$area->area_type_name}}
                                        </option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea cols="30" rows="2" class="form-control"></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label class="display-block">Department Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_active" value="option1" checked>
									<label class="form-check-label" for="product_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="product_inactive" value="option2">
									<label class="form-check-label" for="product_inactive">
									Inactive
									</label>
								</div>
                            </div> -->
                            <div class="m-t-20 text-center">
                                <button  type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{url('departments')}}" class="btn btn-success">Back</a>
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