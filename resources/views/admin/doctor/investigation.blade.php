@foreach($investigation as $test)
<option value="{{$test->test_no}}">{{$test->test_name}}</option>
@endforeach