<thead>
    <tr>
        <th>#</th>
        <th>Test Name</th>
        <th>Routine</th>
        <th>Urgent</th>
        <th>Stat</th>
    </tr>
</thead>
@foreach($rateCenter as $test)
<tr>
    <td>{{$loop->iteration }}</td>
    <td>{{$test->test_name }}</td>
    <td width="100px"><input type="text" placeholder="Routine" class="form-control" /></td>
    <td width="100px"><input type="text" placeholder="Urgent" class="form-control" /></td>
    <td width="100px"><input type="text" placeholder="Stat" class="form-control" /></td>

</tr>
@endforeach