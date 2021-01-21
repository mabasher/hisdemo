@foreach($nsin as $ns)
    <tr>
        <td>{{$ns->reg_no}}</td>
        <td>{{$ns->patName->salutation_id .' '.$ns->patName->ful_name}}</td>
        <td>{{$ns->appoint_no}}</td>
        <td>{{$ns->consult_no}}</td>
        <td>{{$ns->consultation->designation.' '.$ns->consultation->doctor_name}}</td>
        <td mb-2>
            <div class="material-switch">
                <input id="staff_module" type="checkbox">
                <label for="staff_module" class="badge-success">Test</label>
            </div>
        </td>
    </tr>
@endforeach