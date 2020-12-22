@extends('layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-4 col-3">
            <h4 class="page-title">Patient Registration List</h4>
        </div>
        <!-- <div class="col-sm-8 col-9 text-right m-b-20">
            <a href="add-employee.html" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add
                Employee</a>
        </div> -->
    </div>
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">Employee ID</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <label class="focus-label">Employee Name</label>
                <input type="text" class="form-control floating">
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <label class="focus-label">Role</label>
                <select class="select floating">
                    <option>Select Role</option>
                    <option>Nurse</option>
                    <option>Pharmacist</option>
                    <option>Laboratorist</option>
                    <option>Accountant</option>
                    <option>Receptionist</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th style="min-width:200px;">Patient Name</th>
                            <th>PID</th>
                            <th>DOB</th>
                            <th>Mobile</th>
                            <th style="min-width: 110px;">Email</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $reg)
                        <tr>
                            <td>
                                <img width="28" height="28" src="{{$reg->img_url}}" class="rounded-circle" alt="">
                                <h2>{{$reg->ful_name}}</h2>
                            </td>
                            <td><a href="{{url('appointments/'.$reg->reg_no)}}"> {{$reg->reg_no}}</a></td>
                            <td>{{$reg->dob}}</td>
                            <td>{{$reg->mobile}}</td>
                            <td>{{$reg->email}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="edit-employee.html"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i>
                                            Delete</a>
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

@endsection
@section('js')
<script src="{{asset('admin/js/select2.min.js')}}"></script>
<script src="{{asset('admin/js/moment.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap-datetimepicker.min.js')}}"></script>
@endsection