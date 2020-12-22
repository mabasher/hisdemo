<!-- <option value="">Select D</option> -->
@foreach($spWidoctors as $doc)
<option value="{{$doc->id}}">
    {{$doc->designation.' '.$doc->doctor_name.' '.$doc->qualification}}
</option>
@endforeach