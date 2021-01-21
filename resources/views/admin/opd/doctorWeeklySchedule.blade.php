    @foreach($day as $d)
        @if($d->schudules->count()> 0)
        <tr class="bg-success mt-2 {{$d->name == $dayName?'bg-info':'bg-success'}}">
            <th colspan="2"><h4 class="text-white noofDay" data-dId="{{$d->id}}" >{{$d->name}}</h4>
            </th>
            <!-- <input type="hidden" id="noofDay"  data-dId="{{$d->id}}" class="noofDay" value="{{$d->id}}" > -->
        </tr>
        @foreach($d->schudules as $ds)

        <tr class="text-success">
            <td><a href="#" class="text-success">{{$ds->doctorvisit->visit_name}}</a>: </td>
            <td><a href="#" class="text-success">{{ Carbon\Carbon::parse($ds->start_time)->format('h:i A').' - '.Carbon\Carbon::parse($ds->end_time)->format('h:i A')}}</a></td>
        </tr>
        @endforeach
        @endif
    @endforeach