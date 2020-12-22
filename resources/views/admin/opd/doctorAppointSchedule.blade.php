
@if($doctor->schedules->count()>0)
    
    <h3 class="text-center text-success pt-2"> Doctor Weekly Schedules</h3>
    @endif

    <table class="table">
        <tbody>
            @forelse($doctor->schedules as $ds)
            <tr>
                <td>{{$ds->day->name}}</td>
                <td> {{ Carbon\Carbon::parse($ds->sch_start_time)->format('h:i A').' - '.Carbon\Carbon::parse($ds->sch_end_time)->format('h:i A')}} </td>
            </tr>
            @empty
            <h3 class="text-center text-success">No Schedule</h3>
            @endforelse
        </tbody>
    </table>
