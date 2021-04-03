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
    <tr>
        <td class="d-none">
            <input type="text" class="form-control text-center" readonly value="{{$test->test_no}}" placeholder="Test No" />
        </td>
        <td>
            <input type="text" class="form-control" readonly value="{{$test->dctestmst->test_name}}" placeholder="Test Name" />
        </td>
        <td>
            <input type="text" class="form-control" readonly value="{{$test->dctestmst->departments->dept_name}}" placeholder="Department" />
            <input type="hidden" class="form-control" readonly value="{{$test->dctestmst->dept_no}}" placeholder="dept no" />
        </td>
        <!-- <td>
        <input type="hidden" class="form-control text-center" value="{{$test->inv_qty}}" id="Fld_Dflt_Val" placeholder="Quantity" />
    </td> -->
        <td>
            <input type="text" class="form-control text-center" readonly value="{{$test->dctestmst->rate}}" placeholder="Rate" />
        </td>
        <td>
            <input type="text" class="form-control text-center disPercent" value="" id="disPercent_{{$test->id}}" placeholder="Discount%" />
        </td>
        <td>
            <input type="text" class="form-control text-center disFixed" value="" id="disFixed_{{$test->id}}" placeholder="Disc Fixed" />
        </td>
        <td>
            <input type="text" class="form-control text-right totalAmt" data-original="{{$amount}}" value="{{$amount}}" id="totalAmt_{{$test->id}}" placeholder="Total Amt" />
        </td>
        <td>
            <a href="#" class=""><i class="fa fa-plus text-white" aria-hidden="true"></i></a>
        </td>
    </tr>
    @endforeach
    <tr>
        <td class="d-none">
            <input type="text" class="form-control text-center" id="testNo" placeholder="Test No" />
        </td>
        <td>
            <select class="form-control selectpicker testName" name="test_no" data-dept="0" data-live-search="true">
                <option value="Select Part">Select Investigation Name</option>
                @foreach($testshow as $ts)
                <option value="{{$ts->test_no}}" data-tokens="{{$ts->test_name}}">{{$ts->test_name}}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input type="text" class="form-control" id="deptName_d_0" placeholder="Department" />
            <input type="hidden" class="form-control" id="deptNo_d_0" placeholder="dept No" />
        </td>
        <td class="d-none">
            <input type="text" class="form-control text-center" id="qty" placeholder="Quantity" />
        </td>
        <td>
            <input type="text" class="form-control text-center" id="rate_d_0" placeholder="Rate" />
        </td>
        <td>
            <input type="text" class="form-control text-center disPercent" data-id="disPercent" data-dept="0" placeholder="Discount%" />
        </td>
        <td>
            <input type="text" class="form-control text-center disFixed" data-id="disFixed" data-dept="0" placeholder="Disc Fixed" />
        </td>
        <td>
            <input type="text" class="form-control text-right totalAmt" id="totalAmt_d_0" placeholder="Total Amt" />
        </td>
        <td>
            <a href="#" class="text-info" id="addScnt"><i class="fa fa-plus text-success" aria-hidden="true"></i></a>
        </td>
    </tr>
</tbody>


<script>
    $('.selectpicker').selectpicker();
</script>