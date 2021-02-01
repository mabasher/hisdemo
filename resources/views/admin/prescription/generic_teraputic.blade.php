@foreach($genericTherpGrp as $g)
<option value="{{$g->pmgeneric->generic_no}}">{{$g->pmgeneric->generic_name}}</option>
@endforeach