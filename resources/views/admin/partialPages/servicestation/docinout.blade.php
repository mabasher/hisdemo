@foreach($nsin as $ns)
    @if($ns->oppatmovement->count() > 0 && $ns->oppatmovement[0]->opmovetype_id == 3)
    <tr>
        <td>{{$ns->reg_no}}</td>
        <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
        <td>{{$ns->appoint_no}}</td>
        <td>{{$ns->consult_no}}</td>
        <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
    </tr>
    @endif
@endforeach
