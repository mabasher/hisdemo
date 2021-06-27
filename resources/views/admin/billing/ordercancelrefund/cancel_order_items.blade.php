<table class="table table-striped">
    <thead>
        <tr class="text-center">
            <th>Item No</th>
            <th>Item Name</th>
            <th>Rate</th>
            <th>Discount</th>
            <th>Total Amount</th>
            <th><input type="text" class="form-control" id="cancelReasonall" placeholder="Cancel Reason"></th>
            <th><input type="checkbox" class="form-control" id="all"></th>
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
            <td class="text-center"><input type="text" class="form-control cancelReason" id=""
                    placeholder="Cancel Reason" required></td>
            <td class="text-center"><input type="checkbox" class="form-control orderCheek" id="orderCheek"></td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
$(document).ready(function() {
    $("#all").click(function() {
        $(".orderCheek").prop("checked", this.checked);
    });

    $('.orderCheek').click(function() {
        if ($('.orderCheek:checked').length == $('.orderCheek').length) {
            $('#all').prop('checked', true);
        } else {
            $('#all').prop('checked', false);
        }
    });
~
});
</script>