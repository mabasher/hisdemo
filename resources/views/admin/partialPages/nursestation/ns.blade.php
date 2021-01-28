@foreach($nsin as $ns)
    @if($ns->oppatmovement->count() > 0 && $ns->oppatmovement[0]->opmovetype_id == 1)
    <tr>
        <td>{{$ns->reg_no}}</td>
        <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
        <td>{{$ns->appoint_no}}</td>
        <td>{{$ns->consult_no}}</td>
        <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
        <td>
            <div class="checkbox">
                <label>
                <input type="checkbox" id="ns" name="check" class="check" data-consultno="{{$ns->consult_no}}" data-id="{{$ns->id}}" data-moveid="2" data-movemname="Nurse Station IN">
                </label>
            </div>
        </td>
    </tr>
    @endif
@endforeach