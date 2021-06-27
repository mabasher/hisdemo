<style>
    .bg-gray{
        background-color: #d0cfcf !important;
        color:black !important;
    }
</style>
<p id="dT" style="display:none;">{{$schDate}}</p>
@forelse($slot as $s)
    @php
        $booked = 0;
    @endphp
    <div class="col-md slotScroll">
    <h3 class="text-center text-success">{{$s->doctorvisit->visit_name}} 
        <div style="float:right;">
            <span id="slot_{{$s->id}}"></span>
            <span class="text-info" >{{$s->block_load}}</span>
        </div>
        
    </h3>

    <div class="row justify-content-center">
    @for ($i = 0; $i < $s->block_load; $i++)

        @php
            $timeSlot = '';
            $confirmApp = \Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('H:i:s');
            
            if(in_array($confirmApp, $appointConfirm)){
                $timeSlot = 'bg-gray text-white'; 
                $booked++;
            }
            $timeOver = $day.\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('H:i:s');
            $slotTime = \Carbon\Carbon::parse($timeOver)->timestamp;
            $currTime = \Carbon\Carbon::parse(now())->timestamp;

        @endphp

        @if($slotTime > $currTime)
        <div  class="col-md-3 col-sm-6 col-xs-6 m-1 p-0 time-slot {{$timeSlot}} border border-primary text-center text-dark" data-time="{{\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('h:i A')}}">
            <span id="timeId{{$timeSlot}}" data-serial="{{$i+1}}" 
                data-time="{{\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('h:i A')}}">
                {{\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('h:i A')}}
            </span>
        </div>
        @else
        <div class="col-md-3 col-sm-6 col-xs-6 m-1 p-0 time-slot {{$timeSlot}} border border-info text-center bg-gray" data-time="{{\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('h:i A')}}">
            <span class="expTime">
                {{\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('h:i A')}}
            </span>
        </div>
        @endif
        @endfor
    </div>
    </div>
    <script>
        document.getElementById('slot_{{$s->id}}').innerHTML = "{{$booked}}/";
    </script>
@empty
        <h3 class="text-success justify-content-center">No Schedule</h3>
@endforelse

