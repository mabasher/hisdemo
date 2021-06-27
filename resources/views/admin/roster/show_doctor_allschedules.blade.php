
<table class="table">
    <tbody>
        @foreach($days as $key=>$ds)
        <tr id="">
            <td width="100">{{$ds->name}}</td>
            <td>
                <input type="checkbox" name="day_id[]" value="{{$ds->id}}"  {{count($ds->schudules) > 0?'Checked':''}}>
            </td>
            @if(count($ds->schudules) > 0)
            @foreach($ds->schudules as $sch)
            <td width="50">
                    <input type="text" name="avg_duration{{$ds->name}}" value="{{$sch->avg_duration}}"
                        placeholder="Visit Duration" class="form-control" />
                    <input type="hidden" name="schedule_id{{$ds->name}}[]" value="{{$sch->id}}">
            </td>
            <td>
            
                <select class="custom-select" name="doctorvisit_id{{$ds->name}}[]">
                    <option value="">Visit Time</option>
                    @foreach($visits as $v)
                    <option {{$v->id==$sch->doctorvisit_id?'selected':''}} value="{{$v->id}}">
                        {{$v->visit_name}}</option>
                    @endforeach
                </select>
                <input type="text" name="start_time{{$ds->name}}[]" value="{{$sch->start_time}}"
                    placeholder="Enter Start Time" class="form-control timepicker" />

                <input type="text" name="end_time{{$ds->name}}[]" value="{{$sch->end_time}}"
                    placeholder="Enter End Time" class="form-control timepicker" />

                @endforeach
                @else
                <td width="80">
                    <input type="text" name="avg_duration{{$ds->name}}" 
                        placeholder="Visit Duration" class="form-control" />
                        <input type="hidden" name="schedule_id{{$ds->name}}[]" value="">
                </td>
                <td>
                <select class="custom-select" name="doctorvisit_id{{$ds->name}}[]">
                    <option value="">Visit Time</option>
                    @foreach($visits as $v)
                    <option value="{{$v->id}}">
                        {{$v->visit_name}}</option>
                    @endforeach
                </select>
                <input type="text" name="start_time{{$ds->name}}[]"
                    placeholder="Enter Start Time" class="form-control timepicker" />

                <input type="text" name="end_time{{$ds->name}}[]"
                    placeholder="Enter End Time" class="form-control timepicker" />
            
            </td>
            @endif
            <td>
                <div id="extraTime{{$ds->id}}" class="d-flex scroldiv">
                </div>

            </td>
            <td><button type="button" data-id="{{$ds->id}}" data-day="{{$ds->name}}"
                    name="add" class="btn btn-success add">+</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
function initTimePicker() {
    $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 15,
        minTime: '10',
        maxTime: '10:00pm',
        // defaultTime: '11',
        startTime: '10:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
}
initTimePicker();


</script>
