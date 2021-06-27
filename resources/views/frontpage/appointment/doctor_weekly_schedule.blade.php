@foreach($day as $d)
@if($d->schudules->count()> 0)
    <div class="text-center bg-info rounded {{$d->name == $dayName?'bg-dark':'bg-info'}}">
        <h4 class="text-white noofDay text-center" data-dId="{{$d->id}}">{{$d->name}}</h4>
    </div>
    <!-- <ul class="list-group list-group-flush"> -->
        @foreach($d->schudules as $ds)
        <h6 class="border rounded text-center ">{{$ds->doctorvisit->visit_name}} : {{ Carbon\Carbon::parse($ds->start_time)->format('h:i A').' - '.Carbon\Carbon::parse($ds->end_time)->format('h:i A')}}</h6>
        @endforeach
    <!-- </ul> -->
@endif
@endforeach

<!-- bg-success {{$d->name == $dayName?'bg-info':'bg-success'}} -->
