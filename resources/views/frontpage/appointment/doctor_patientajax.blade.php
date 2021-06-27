
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="{{asset('admin/img/fake.jpg')}}" alt="Admin" class="rounded-circle" width="150">
                <div class="mt-3">
                    <h4 class="text-success">{{$doctor->doctor_name}}</h4>
                    <input id="doctorId"  type="hidden" value="{{$doctor->id}}">
                    <input  type="hidden" value="{{$doctor->doctor_no}}">
                    <input  type="hidden" value="{{$doctor->doc_chember}}">
                    <p class="text-info mb-1">{{$doctor->designation.', '.$doctor->department->dept_name}}</p>
                    <p class="text-muted font-size-sm">{{$doctor->qualification}}</p>
                    <a href="{{url('doctorprofile/'.$doctor->id)}}" id="profile" class="btn btn-outline-success">Profile</a>
                    <a href="{{url('doctorpage')}}" class="btn btn-outline-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
    @foreach($doctorDept as $dd)
    <table class="table table-sm border mt-3">
        <tbody>
            <tr>
                <td class="text-primary mousepointer deptDoctor" data-id="{{$dd->id}}" data-docNo="{{$dd->doctor_no}}" data-docRoom="{{$dd->doc_chember}}">{{$dd->designation.' '.$dd->doctor_name}} &nbsp; &nbsp;&nbsp;&nbsp;<span class="text-info">{{$dd->qualification}}</span></td>
            </tr>
        </tbody>
    </table>

    @endforeach
