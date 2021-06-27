<table class="table table-striped table-bordered">
    <thead>
        <tr class="">
            <th style="width: 180px;">PID</th>
            <th style="width: 180px;">Patient Name</th>
            <th>DOB</th>
            <th>Age</th>
            <!-- <th>Date of Birth</th> -->
            <th>Mobile</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    
    @foreach($registrations as $reg)
@php
$dob = $reg->dob;
$d =\Carbon\Carbon::parse($reg->dob)->diff(\Carbon\Carbon::now())->format('%d');
$m =\Carbon\Carbon::parse($reg->dob)->diff(\Carbon\Carbon::now())->format('%m');
$y =\Carbon\Carbon::parse($reg->dob)->diff(\Carbon\Carbon::now())->format('%y');
@endphp
<tr>
    <td>
        <img width="28" height="28" src="{{asset($reg->img_url)}}"
            class="rounded-circle" alt="">
        <a href="" class="patientFind" data-regNo="{{$reg->reg_no}}">
            {{$reg->reg_no}}</a>
    </td>
    <td>{{$reg->salutation_id.' '.$reg->ful_name}}</td>
    <td class="dob">{{$reg->dob}}</td>
    <!-- <td>{{Carbon\Carbon::parse($reg->dob)->age}}</td> -->
    <td>{{$y?$y.'Y ':''}}{{$m?$m.'M ':''}}{{$d?$d.'D':''}}</td>
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
                    data-target="#delete_employee"><i
                        class="fa fa-trash-o m-r-5"></i>
                    Delete</a>
            </div>
        </div>
    </td>
</tr>
@endforeach
    </tbody>
</table>
<div class="m-auto">
    {{$registrations->links()}}
</div>

