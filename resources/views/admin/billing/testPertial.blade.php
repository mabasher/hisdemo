<select name="" id="">
@foreach($inv as $ts)
<option  data-value="{{$ts->test_no}}" value="{{$ts->test_name}}">{{$ts->test_name}}</option>
@endforeach
</select>

<!-- <option  data-value="{{$ts->test_no}}" value="{{$ts->test_name}}">{{$ts->test_name}}</option> -->


