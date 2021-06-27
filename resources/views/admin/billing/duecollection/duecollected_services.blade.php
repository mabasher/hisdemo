<table class="table table-striped">
    <thead>
        <tr class="text-center">
            <th>Item No</th>
            <th>Item Name</th>
            <th>Rate</th>
            <th>Discount</th>
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody id="serviceShow">
        @foreach($services as $test)
        <tr>
            <td class="text-center">{{$test->investigations->test_no}}</td>
            <td>{{$test->investigations->test_name}}</td>
            <td class="text-center">{{$test->investigations->rate}}</td>
            <td class="text-center">{{$test->disc_amt}}</td>
            <td class="text-center">{{$test->bill_amt}}</td>
        </tr>
        @endforeach
    </tbody>
</table>