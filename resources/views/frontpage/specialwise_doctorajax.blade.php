@foreach($deptdoctors as $doc)
<option value="{{$doc->id}}">{{$doc->doctor_name}}</option>
@endforeach