@foreach($nsin as $ns)
    @if($ns->oppatmovement->count() > 0 && $ns->oppatmovement[0]->opmovetype_id == 2)
    <tr>
        <td>{{$ns->reg_no}}</td>
        <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
        <td>{{$ns->appoint_no}}</td>
        <td>{{$ns->consult_no}}</td>
        <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
        <td>
            <div class="radio">
                <label>
                    <input type="radio" name="radio" data-consultno="{{$ns->consult_no}}" data-id="{{$ns->id}}" data-moveid="3" data-movemname="Vital Sign Completed" data-regno="{{$ns->reg_no}}" value="{{$ns->id}}">
                </label>
            </div>
        </td>
    </tr>
    @endif
@endforeach