@extends('layouts.app')
@section('css')
<style>
    body {
        background: #74ebd5;
        background: -webkit-linear-gradient(to right, #74ebd5, #ACB6E5);
        background: linear-gradient(to right, #74ebd5, #ACB6E5);
        min-height: 100vh;

    }

    #addScnt {
        color: #fff;
    }

    .form-control {
        border-radius: 0px;
    }

    #addScnt,
    #remScnt {
        text-decoration: none;
        padding: 5px 25px;
    }

    #addScnt {
        color: #fff;
    }

    #remScnt {
        color: #c23f44;
    }

    /* .tx-lg {
        width: 175px !important;
    }

    .tx-md {
        width: 130px !important;
    }

    .tx-sm {
        width: 80px !important;
    } */

    .col-md {
        position: relative;
        width: 100%;
        padding-right: 0px;
        padding-left: 15px;
    }

    input[type=text] {
        width: 100% !important;
    }

    .form-group {
        margin-bottom: 5px;
    }

    .form-control {
        min-height: 38px;
    }

    .bootstrap-select>.dropdown-toggle {
        width: 220px !important;

    }
</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">


@endsection
@section('content')
<div class="content">
    <div class="row m-auto">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card w-100 p-3">
                        <div class="row">
                            <div class="col">
                                <label for="">PID</label>
                                <input type="text" id="pid" class="form-control" placeholder="PID" autofocus>
                            </div>
                            <div class="col">
                                <label for="">CID</label>
                                <input type="text" id="cid" class="form-control" placeholder="CID">
                            </div>
                            <div class="col">
                                <label for="">Patient Name</label>
                                <input type="text" id="fulName" class="form-control" readonly placeholder="Patient Name">
                            </div>
                            <div class="col">
                                <label for="">Age & Gender</label>
                                <input type="text" id="dob" class="form-control" readonly placeholder="Age">
                            </div>
                            <!-- <div class="col">
                                    <label for="">Gender</label>
                                    <input type="text" class="form-control" placeholder="Gender">
                                </div> -->
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Contact No</label>
                                <input type="text" id="mobile" class="form-control" readonly placeholder="Contact No">
                            </div>
                            <div class="col">
                                <label for="">Cash Point</label>
                                <select class="form-control" id="exampleFormControlSelect1" readonly>
                                    <option value="OC">OPD Billing</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Ref By</label>
                                <input type="text" class="form-control" readonly placeholder="Referred by">
                            </div>
                            <div class="col">
                                <label for="">Care Giver</label>
                                <input type="text" id="doctor" class="form-control" readonly placeholder="Care Giver">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-header text-success border-bottom">
                            <b>TODAYS SUMMARY</b>
                        </div>
                        <div class="card-body">
                            <h5 class="">Cashier</h5>
                            <h5 class="">Total Amount</h5>
                            <h5 class="">Total Invoice</h5>
                            <a href="#" class="btn btn-success">Show Details</a>
                        </div>
                        <!-- <div class="card-footer text-muted">
                                2 days ago
                            </div> -->
                    </div>
                </div>
            </div>
            <div class="card w-100 p-3">
                <form class="form-inline" role="form">
                    <table id="p_scents">
                        <thead>
                            <tr class="text-center">
                                <th>Test Name</th>
                                <th>Department</th>
                                <th>Rate</th>
                                <th>Discount%</th>
                                <th>Discount Fixed</th>
                                <th>Total Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="frm_scents">
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
                                    <input type="text" class="form-control text-center disFixed" data-id="disFixed" placeholder="Disc Fixed" />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-right totalAmt" id="totalAmt_d_0" placeholder="Total Amt" />
                                </td>
                                <td>
                                    <a href="#" class="text-info" id="addScnt"><i class="fa fa-plus text-success" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card w-100 p-3">
                <div class="row">

                    <div class="col-sm-12 col-md-10 col-lg-6 m-auto">
                        <div class="card">
                            <!-- <div class="card-header text-success border-bottom">
                                    <b>TODAYS SUMMARY</b>
                                </div> -->
                            <div class="card-body border border-info">
                                <div class="text-center mb-2">
                                    <button type="button" class="btn btn-sm btn-success">Invoice</button>
                                    <button type="button" id="newBill" class="btn btn-sm btn-success">New Bill</button>
                                    <button type="button" class="btn btn-sm btn-success">Make Quick PID </button>
                                    <button type="button" class="btn btn-sm btn-success">Cancel Order</button>
                                </div>

                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Grant Total</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="colFormLabelSm" placeholder="Grant Total" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Discount</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="colFormLabelSm" placeholder="Discount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Receive Amount</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="colFormLabelSm" placeholder="Receive Amount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Paid Amount</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="colFormLabelSm" placeholder="Paid Amount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Change Amount</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="colFormLabelSm" placeholder="Change Amount" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Due Amount</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="colFormLabelSm" placeholder="Due Amount" />
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card-footer text-muted">
                                    2 days ago
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script>
    var i = 1;

    $(function() {


        $(document).on('click', "#addScnt", function() {


            let rw = `<tr id="p_scents">
            <td class="d-none">
            <input type="text" class="form-control text-center" id="testNo(${i})" placeholder="Test No"/>
            </td>
            <td>
                <select class="form-control selectpicker testName" name="test_no" data-dept="${i}" data-live-search="true">
                    <option value="Select Part">Select Investigation Name</option>
                    @foreach($testshow as $ts)
                    <option value="{{$ts->test_no}}" data-tokens="{{$ts->test_name}}">{{$ts->test_name}}</option>
                    @endforeach
                </select></td>
            <td>
                <input type="text" class="form-control" id="deptName_d_${i}" placeholder="Department" />
                <input type="hidden" class="form-control" id="deptNo_d_${i}" placeholder="dept No" />
            </td>
            <td class="d-none">
                <input type="text" class="form-control text-center" id="qty(${i})" placeholder="Quantity"/></td>
                <td><input type="text" class="form-control text-center" id="rate_d_${i}" placeholder="Rate"/></td>
            <td><input type="text" class="form-control text-center disPercent" data-id="disPercent" data-dept="${i}"  placeholder="Discount % "/></td>
            <td><input type="text" class="form-control text-center" data-id="disFixed_${i}d" placeholder="Disc Fixed "/></td>
            <td><input type="text" class="form-control text-right" data-original="" id="totalAmt_d_${i}" placeholder="Total Amt " /></td>
            <td><a href="#" id="remScnt" onclick="removeCont(this);">
            <i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>`;

            i++;
            $("#frm_scents").append(rw);
            $('.selectpicker').selectpicker();
            return false;
        });

        $('.selectpicker').selectpicker();

    });


    function removeCont(_this) {
        if (i > 1) {
            // $(_this).parent().parent().remove();
            $(_this).closest('tr').remove();
            // i--;
        }
    }

    $('#newBill').on('click', function() {
        $('#pid').val('');
        $('#cid').val('');
        $('#fulName').val('');
        $('#mobile').val('');
        $('#doctor').val('');
        $('#dob').val('');
    })


    $(document).on('keyup', '.disPercent', function() {
        let discount = $(this).val();
        if ($(this).attr('data-id') === 'disPercent') {
            let id = $(this).attr('data-dept');

            let amount = $('#totalAmt_d_' + id).attr('data-original');
            let disAmount = amount * discount / 100;
            let amountAfterDiscount = amount - disAmount;
            $('#totalAmt_d_' + id).val(amountAfterDiscount);
        } else {
            let id = $(this).attr('id').split('_');

            let amount = $('#totalAmt_' + id[1]).attr('data-original');
            let disAmount = amount * discount / 100;
            let amountAfterDiscount = amount - disAmount;
            $('#totalAmt_' + id[1]).val(amountAfterDiscount);
        }

    })

    $(document).on('keyup', '.disFixed', function() {
        let id = $(this).attr('id').split('_');
        let discount = $(this).val();
        let amount = $('#totalAmt_' + id[1]).attr('data-original');
        let amountAfterDiscount = amount - discount;
        $('#totalAmt_' + id[1]).val(amountAfterDiscount);
    })


    $('#pid').keypress(function(e) {
        var pid = $('#pid').val();
        if (e.which == 13) {
            getPatientInfo(pid);

        }
        console.log(pid);
    })


    function getPatientInfo(regNo) {
        $.ajax({
            url: "{{url('patientBilling')}}/" + regNo,
            type: 'get',
            success: function(data) {
                var gender = data.Billing.pat_appinfo.gender == 'M' ? 'Male' : (data.Billing.pat_appinfo.gender == 'F' ? 'Female' : 'Others');
                $('#pid').val(data.Billing.reg_no);
                $('#cid').val(data.Billing.consult_no);
                $('#fulName').val(data.Billing.pat_appinfo.salutation_id + ' ' + data.Billing.pat_appinfo.ful_name);
                $('#mobile').val(data.Billing.pat_appinfo.mobile);
                $('#doctor').val(data.Billing.consultation.designation + ' ' + data.Billing.consultation.doctor_name);
                $('#dob').val(data.Age + ', ' + gender);
                getPrescripTest(regNo);

            }
        })
    }

    function getPrescripTest(regNo) {
        $.ajax({
            url: "{{url('patientTest')}}/" + regNo,
            type: 'get',
            success: function(data) {
                $('#p_scents').html(data);

            }
        })
    }

    $(document).on('change', '.testName', function() {
        var testNo = $(this).val();
        var testVal = $(this).attr('data-dept');
        getDepartment(testNo, testVal);
    })

    function getDepartment(testNo, testVal) {
        $.ajax({
            url: "{{url('testDept')}}/" + testNo,
            type: 'get',
            success: function(data) {
                $('#deptNo_d_' + testVal).val(data.dept_no);
                if (data.departments != null) {
                    $('#deptName_d_' + testVal).val(data.departments.dept_name);
                }
                $('#rate_d_' + testVal).val(data.rate);
                $('#totalAmt_d_' + testVal).val(data.rate).attr('data-original', data.rate);
            }
        })
    }
</script>
@stop