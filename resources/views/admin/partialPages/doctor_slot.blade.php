@foreach($slot as $s)
    @php
        $booked = 0;
    @endphp
    <div class="col-md slotScroll">
    <h3 class="text-center text-success">{{$s->multivisit_name}} 
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
                $timeSlot = 'bg-secondary'; 
                $booked++;
            }

        @endphp
        <div class="col-md-3 col-sm-6 col-xs-6 m-1 p-0 time-slot {{$timeSlot}}">
            <span id="timeId{{$timeSlot}}" data-serial="{{$i+1}}"
                data-time="{{\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('h:i A')}}">
                {{\Carbon\Carbon::parse($s->start_time)->addMinutes($s->avg_duration * $i)->format('h:i A')}}
            </span>
        </div>
        @endfor
    </div>
    </div>
    <script>
        document.getElementById('slot_{{$s->id}}').innerHTML = "{{$booked}}/";
    </script>
@endforeach
