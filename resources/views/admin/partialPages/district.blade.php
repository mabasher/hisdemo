<!-- <option value="">Select City</option> -->
@foreach($district as $city)
<option value="{{$city->district_code}}">{{$city->district_name}}</option>
@endforeach