<tr class="frm_scents">
    @php $amount = $investigation->rate * 1; @endphp
    <td class="d-none">
        <input type="text" class="form-control text-center" name="test_no[]" id="testNo" placeholder="Test No" value="{{$testNo}}" />
    </td>
    <td>
        <input type="text" class="form-control testName" readonly value="{{$investigation->test_name}}" id="testName" placeholder="Test Name" />

    </td>
    <td>
        <input type="text" class="form-control" readonly value="{{$investigation->departments? $investigation->departments->dept_name:''}}" id="deptName_d_0" placeholder="Department" />
        <input type="hidden" class="form-control" name="dept_no[]" readonly id="deptNo_d_0" placeholder="dept No" />
    </td>
    <td class="d-none">
        <input type="text" class="form-control text-center" readonly id="qty" placeholder="Quantity" />
    </td>
    <td>
        <input type="text" class="form-control text-center" readonly value="{{$investigation->rate}}" id="rate_d_0" placeholder="Rate" />
    </td>
    <td>
        <input type="number" class="form-control text-center disPercent" id="disPercent_{{$investigation->id}}" data-dept="0" placeholder="Discount%" />
    </td>
    <td>
        <input type="number" class="form-control text-center disFixed" name="disc_amt[]" id="disFixed_{{$investigation->id}}" data-dept="0" placeholder="Disc Fixed" />
    </td>
    <td>
        <input type="text" class="form-control text-right totalAmt" name="bill_amt[]" readonly value="{{$amount}}" data-original="{{$amount}}" id="totalAmt_{{$investigation->id}}" id="totalAmt_d_0" placeholder="Total Amt" />
    </td>
    <td>
        <a href="#" id="remScnt" class="dlt"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </td>

</tr>

<script>
    $('.dlt').on('click', function() {
        $(this).closest('tr').remove();
        invoiceSum();

        var count =
            Array.prototype.slice.call(
                document.getElementsByClassName("frm_scents")
            ).length

        if(count == 0){
            $('#prompt').hide();
        }
    });


    // var val = "";
    // var i;
    // for (i = 0; i > 0; i++) {
    //     val +=  i ;
    //     alert(val);
    // }
    // $('.dlt').html(val);
    // document.getElementById("dlt").innerHTML = val;
</script>