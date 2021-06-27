<thead>
    <tr class="text-center">
        <th>Investigation</th>
        <th>Department</th>
        <th>Rate</th>
        <th>Discount%</th>
        <th>Discount Fixed</th>
        <th>Total Amount</th>
        <th></th>
    </tr>
</thead>
<tbody id="frm_scents">
    @foreach($test as $test)
    @php $amount = $test->dctestmst->rate * $test->inv_qty; @endphp
    <tr class="frm_scents">
        <td class="d-none">
            <input type="text" class="form-control text-center" name="test_no[]" readonly value="{{$test->test_no}}" placeholder="Test No" />
        </td>
        <td>
            <input type="text" class="form-control" readonly value="{{$test->dctestmst->test_name}}" placeholder="Test Name" />
        </td>
        <td>
            <input type="text" class="form-control" readonly value="{{$test->dctestmst->departments->dept_name}}" placeholder="Department" />
            <input type="hidden" class="form-control" name="dept_no[]" readonly value="{{$test->dctestmst->dept_no}}" placeholder="dept no" />
            <input type="hidden" class="form-control" name="service_type[]" readonly value="{{$test->dctestmst->service_type}}"/>
            <input type="hidden" class="form-control" name="sample_no[]" readonly value="{{$test->dctestmst->req_sample}}"/>
            <input type="hidden" class="form-control" name="trx_code_no[]" readonly value="GS" />
        </td>
        <!-- <td>
        <input type="hidden" class="form-control text-center" value="{{$test->inv_qty}}" id="Fld_Dflt_Val" placeholder="Quantity" />
    </td> -->
        <td>
            <input type="text" class="form-control text-center" readonly value="{{$test->dctestmst->rate}}" placeholder="Rate" />
        </td>
        <td>
            <input type="number" class="form-control text-center disPercent" value="" id="disPercent_{{$test->id}}" placeholder="Discount%" />
        </td>
        <td>
            <input type="number" class="form-control text-center disFixed" name="disc_amt[]" value="" id="disFixed_{{$test->id}}" placeholder="Disc Fixed" />
        </td>
        <td>
            <input type="text" readonly class="form-control text-right totalAmt" name="bill_amt[]"  data-original="{{$amount}}" value="{{$amount}}" id="totalAmt_{{$test->id}}" placeholder="Total Amt" />
        </td>
        <td>
        <a href="#" id="remScnt" class="dlt"><i class="fa fa-trash" aria-hidden="true"></i></a>
        </td>
    </tr>
    @endforeach
    
</tbody>


<script>
    $('.selectpicker').selectpicker();

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
</script>