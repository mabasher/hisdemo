
@if($doctor->schedules->count()>0)
<div class="border border-success slotScroll">

                                                    
    <h3 class="text-center text-success pt-2"> Doctor Weekly Schedules</h3>

    <table class="table">
        <tbody>
            @foreach($doctor->schedules as $ds)
            <tr>
                <td>{{$ds->day->name}}</td>
                <td> {{ Carbon\Carbon::parse($ds->sch_start_time)->format('h:i A').' - '.Carbon\Carbon::parse($ds->sch_end_time)->format('h:i A')}} </td>
            </tr>
            
            @endforeach
        </tbody>
    </table>
    </div>
    @endif
