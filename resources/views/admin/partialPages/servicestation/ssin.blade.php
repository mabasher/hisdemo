@foreach($ssin as $ssin)
    @if($ssin->oppatmovement->count() > 0 && $ssin->oppatmovement[0]->opmovetype_id == 3)
    <tr>
        <td>{{$ssin->reg_no}}</td>
        <td>{{$ssin->patName->salutation_id .' '.$ssin->patName->ful_name}}</td>
        <td>{{$ssin->appoint_no}}</td>
        <td>{{$ssin->consult_no}}</td>
        <td>{{$ssin->consultation->designation.' '.$ssin->consultation->doctor_name}}</td>
        <td>{{$ssin->consultation->doc_chember}}</td>
        <td>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="check" name="checkbox" data-consultno="{{$ssin->consult_no}}" data-id="{{$ssin->id}}" data-moveid="4" data-movemname="Service Station IN" data-regno="{{$ssin->reg_no}}" value="{{$ssin->id}}">
                </label>
            </div>
        </td>
    </tr>
    @endif
@endforeach