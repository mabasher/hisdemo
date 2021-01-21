@foreach($doctor->appoints as $pat)
<div class="col-md-6">
    <ul class="categories border-bottom">
        <li><a href="{{url('prescriptions')}}" class="text-success"><i class="fa fa-long-arrow-right"></i>{{$pat->reg_no}}</a></li>
    </ul>
</div>
<div class="col-md-6">
    <ul class="categories border-bottom">
        <li>{{$pat->ful_name}}</li>
    </ul>
</div>
@endforeach