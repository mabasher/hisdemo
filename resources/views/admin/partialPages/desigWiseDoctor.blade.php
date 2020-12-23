<!-- <option value="">Select D</option> -->
@foreach($desigWidoctors as $doc)
<option value="{{$doc->id}}">
    {{$doc->designation.' '.$doc->doctor_name.' '.$doc->qualification}}
</option>
@endforeach