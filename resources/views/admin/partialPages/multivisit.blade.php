<!-- <option value="">Select D</option> -->
@foreach($visitTime as $vt)
<option value="{{$vt->multivisit_no}}">
    {{$vt->multivisit_name.' ( '.\Carbon\Carbon::parse($vt->start_time)->format('h:i A').' - '.\Carbon\Carbon::parse($vt->end_time)->format('h:i A').' )'}}
</option>
    <!-- <button class="btn btn-sm">{{$vt->multivisit_name.' ( '.\Carbon\Carbon::parse($vt->start_time)->format('h:i A').' - '.\Carbon\Carbon::parse($vt->end_time)->format('h:i A').' )'}}</button> -->
@endforeach
