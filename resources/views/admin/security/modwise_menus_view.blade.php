<thead>
    <tr class="filters">
        <th>#</th>
        <th><input type="text" class="form-control" placeholder="Main Menu"></th>
        <th class="text-center">Action</th>
    </tr>
</thead>
@foreach($modWise as $mw)
<tr>
    <td class="text-center">{{$loop->iteration }}</td>
    <td>{{$mw->name }}</td>
    <td class="text-center">
        <a href=""><i class="fa fa-pencil m-r-5"></i></a>
        <a class="dlt" data-id="{{$mw->id}}" href="#"><i class="fa fa-trash-o m-r-5 text-danger"></i></a>
    </td>
</tr>
@endforeach