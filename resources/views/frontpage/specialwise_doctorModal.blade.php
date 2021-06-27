@foreach($deptcareGiver as $doccg)
<option value="{{$doccg->id}}">{{$doccg->doctor_name}}</option>
@endforeach